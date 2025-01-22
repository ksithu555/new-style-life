<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Process;
use Barryvdh\DomPDF\Facade\PDF as PDF;
use App\Models\OrderDetail;
use App\Models\Notification;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function sellerAllOrder()
    {
        $validated = request()->validate([
            'search' => 'string|nullable',
        ]);

        $search = $validated['search'] ?? null;
        $limit = 10;
        $id = Auth::user()->created_by ?? Auth::id();

        $orderQuery = OrderDetail::with('order')
            ->where('seller_id', $id)
            ->where('payment_approved', 1)
            ->where('status', '!=','Cancel')
            ->groupBy('order_id')
            ->selectRaw('order_id, MAX(created_at) as created_at, MAX(id) as id, MAX(amount) as amount, MAX(status) as status')
            ->orderBy('created_at', 'desc');

        if ($search) {
            $orderQuery->where(function($query) use ($search) {
                $query->where('order_id', 'LIKE', "%{$search}%")
                    ->orWhereHas('order', function($q) use ($search) {
                        $q->where('order_code', 'LIKE', "%{$search}%");
                    });
            });
        }

        $order = $orderQuery->paginate($limit);

        $cancelledOrderQuery = OrderDetail::with('order')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select('order_details.*', 'products.product_name')
            ->where('order_details.seller_id', $id)
            ->where('order_details.status', 'Cancel')
            ->where('payment_approved', 1)
            ->orderBy('order_details.created_at', 'desc');

        if ($search) {
            $cancelledOrderQuery->where(function($query) use ($search) {
                $query->where('order_id', 'LIKE', "%{$search}%")
                    ->orWhereHas('order', function($q) use ($search) {
                        $q->where('order_code', 'LIKE', "%{$search}%");
                    })
                    ->orWhere('products.product_name', 'LIKE', "%{$search}%");
            });
        }

        $cancelledOrder = $cancelledOrderQuery->paginate($limit);

        $ttl = $order->total();
        $ttlpage = ceil($ttl / $limit);
        $cancelttl = $cancelledOrder->total();
        $cancelttlPage = ceil($cancelttl / $limit);

        return view('seller.order.order_all', compact('order','ttl','ttlpage','cancelledOrder','cancelttl','cancelttlPage'));
    }


    public function sellerDetailOrder($id)
    {
        $sellerId = Auth::user()->created_by ?? Auth::id();
        $orderDetails = OrderDetail::join('orders', 'order_details.order_id', 'orders.id')
                ->join('products', 'products.id', 'order_details.product_id')
                ->with('prefecture')
                ->select(
                    'orders.id as order_id',
                    'order_details.id as order_detail_id',
                    'products.id as product_id',
                    'orders.*',
                    'products.*',
                    'products.selling_price as price',
                    'order_details.*',
                    'orders.created_at as order_created_at',
                )
                ->where('order_details.seller_id', $sellerId)
                ->where('order_details.order_id', $id)
                ->where('order_details.status', '!=', 'Cancel')
                ->get();

        return view('seller.order.order_detail', compact('orderDetails'));
    }

    public function updateOrderStatus(Request $request)
    {
        $data = OrderDetail::find($request->id);
        $order_id = $data->order_id;
        $status = $request->input('status');
        $orderItems = OrderDetail::where('order_id', $order_id)->where('seller_id', Auth::user()->id)->where('status', '!=','Cancel')
                    ->with('product')->with('buyer')->with('seller')->with('order')->get();
        $mailSendStatus = 0;

        foreach($orderItems as $item) {
            if (empty($item->confirmed_date)) {
                $request->validate([
                    'expected_from' => 'required|string|max:255',
                    'expected_to' => 'required|string|max:255',
                ]);
                $item->expected_from = now();
                $item->expected_to = now();
                $item->confirmed_date = now();
                $item->status = 'Confirmed';
                UserNotification::create([
                    'order_detail_id' => $item->id,
                    'buyer_id' => $item->buyer_id,
                    'title' => 'Confirmed',
                    'seen' => 0,
                ]);
                $mailSendStatus = 1;
            } else {
                switch ($status) {
                    case 'Processing':
                        $item->processing_date = now();
                        $item->status = 'Processing';
                        break;
                    case 'Picked':
                        $item->picked_date = now();
                        $item->status = 'Picked';
                        break;
                    case 'Shipped':
                        $item->shipped_date = now();
                        $item->status = 'Shipped';
                        break;
                    case 'Delivered':
                        $item->delivered_date = now();
                        $item->status = 'Delivered';
                        UserNotification::create([
                            'order_detail_id' => $item->id,
                            'buyer_id' => $item->buyer_id,
                            'title' => 'Delivered',
                            'seen' => 0,
                        ]);
                        $mailSendStatus = 1;
                        break;
                    default:
                        $item->cancel_date = now();
                        $item->status = 'Cancel';
                        UserNotification::create([
                            'order_detail_id' => $item->id,
                            'buyer_id' => $item->buyer_id,
                            'title' => 'Cancel',
                            'seen' => 0,
                        ]);
                        $mailSendStatus = 1;
                        break;
                }
            }
            $item->save();
        }

        $process = new Process();
        $process->order_id = $order_id;
        $process->{$status . '_date'} = now();
        $process->updated_by = Auth::user()->name;
        $process->save();
        if ($mailSendStatus == 1) {
            \Mail::to($orderItems->first()->buyer->email)->send(new \App\Mail\BuyerOrderTracking($orderItems));
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                \Mail::to($admin->email)->send(new \App\Mail\AdminOrderTracking($orderItems, $admin));
            }
        }

        $msg = ('Order status updated Successfully');
        return back()->with('success', $msg);

    }

    public function cancelOrder(Request $request)
    {
        $data = OrderDetail::find($request->id);
        $order_id = $data->order_id;
        $sellerId = Auth::user()->created_by ?? Auth::id();
        $orderDetails = OrderDetail::join('orders', 'order_details.order_id', 'orders.id')
                        ->join('products', 'products.id', 'order_details.product_id')
                        ->with('prefecture')
                        ->select(
                            'orders.id as order_id',
                            'order_details.id as order_detail_id',
                            'products.id as product_id',
                            'orders.*',
                            'products.*',
                            'products.selling_price as price',
                            'order_details.*',
                            'orders.created_at as order_created_at',
                        )
                        ->where('order_details.seller_id', $sellerId)
                        ->where('order_details.order_id', $order_id)
                        ->get();
        return view('seller.order.order_cancel',compact('orderDetails'));
    }

    public function cancelOrderReason(Request $request)
    {
        $validatedData = $request->validate([
            'cancelled_reason' => 'present|string|max:255',
        ]);
        $order = OrderDetail::find($request->id);
        $order->status = 'Cancel';
        $order->cancelled_reason = $validatedData['cancelled_reason'];
        $order->cancel_date = now();
        $order->save();
        UserNotification::create([
            'order_detail_id' => $order->id,
            'buyer_id' => $order->buyer_id,
            'title' => 'Cancel',
            'seen' => 0,
        ]);

        \Mail::to($order->buyer->email)->send(new \App\Mail\BuyerOrderCancel($order));
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            \Mail::to($admin->email)->send(new \App\Mail\AdminOrderCancel($order, $admin));
        }

        $msg = ('Order cancelled Successfully');
        return redirect('/orderlist')->with('success', $msg);
    }

    public function orderTracking($id)
    {
        $process = Process::where('order_id',$id)->latest()->get();
        $sellerId = Auth::user()->created_by ?? Auth::id();
        $orderDetails = OrderDetail::join('orders', 'order_details.order_id', 'orders.id')
                    ->join('products', 'products.id', 'order_details.product_id')
                    ->join('buyers', 'orders.buyer_id', 'buyers.id')
                    ->with('prefecture')
                    ->select(
                        'orders.id as order_id',
                        'order_details.id as order_detail_id',
                        'products.id as product_id',
                        'orders.*',
                        'products.*',
                        'products.selling_price as price',
                        'order_details.*',
                        'orders.created_at as order_created_at',
                        'buyers.name as buyer_name'
                    )
                    ->where('order_details.seller_id', $sellerId)
                    ->where('order_details.order_id', $id)
                    ->get();

        return view('seller.order.order_tracking',compact('orderDetails','process'));
    }


    public function generatePDF($id)
    {
        $orderdetail = OrderDetail::find($id);
        $data = OrderDetail::with('seller')->with('buyer')->with('order')
                ->with('prefecture')->with('product')->where('order_id', $orderdetail->order_id)
                ->where('seller_id', $orderdetail->seller_id)->where('status', '!=', 'Cancel')->get();

        $html = view('seller.order.invoice', compact('data'))->render();

        $htmlFilePath = public_path('temp_invoice.html');
        file_put_contents($htmlFilePath, $html);

        $pdfFilePath = public_path('invoice.pdf');
        $wkhtmltopdfPath = '/usr/local/bin/wkhtmltopdf';

        $command = escapeshellcmd("$wkhtmltopdfPath $htmlFilePath $pdfFilePath");
        exec($command . ' 2>&1', $output, $return_var);

        if ($return_var !== 0) {
            return response()->json([
                'error' => 'PDF generation failed',
                'details' => $output
            ], 500);
        }

        if (!file_exists($pdfFilePath)) {
            return response()->json(['error' => 'PDF file does not exist'], 500);
        }

        return response()->download($pdfFilePath)->deleteFileAfterSend(true);
    }
}