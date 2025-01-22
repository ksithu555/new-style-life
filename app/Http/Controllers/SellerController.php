<?php

namespace App\Http\Controllers;

use Mail;
use DateTime;
use Carbon\Carbon;
use App\Models\Help;
use App\Models\User;
use App\Models\Order;
use App\Models\Reply;
use App\Models\Seller;
use App\Models\Country;
use App\Models\Product;
use App\Models\Transfer;
use App\Models\Subseller;
use App\Models\OrderDetail;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\SellerNotification;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class SellerController extends Controller
{
    public function dashboard()
    {
        $limit = 10;
        $id = Auth::user()->created_by ?? Auth::id();
        $revenue = OrderDetail::where('seller_id', $id)->where('status', 'Delivered')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('amount');
        $order = OrderDetail::where('seller_id', $id)
            ->where('status', '!=', 'Cancel')
            ->where('payment_approved', 1)
            ->groupBy('order_id')
            ->selectRaw('order_id, MAX(created_at) as created_at, MAX(id) as id')
            ->get();
        $pending = OrderDetail::where('seller_id', $id)->where('status', 'Pending')->get();
        $product = Product::where('seller_id', $id)->get();
        // $transfer = OrderDetail::where('seller_id',$id)->latest()->paginate($limit);
        $orders = OrderDetail::where('seller_id', $id)->selectRaw("COUNT(*) as count, DATE_FORMAT(created_at, '%M') as month_name")
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("MONTH(created_at)"), 'created_at')
            ->pluck('count', 'month_name');

        $ordergraph = OrderDetail::where('seller_id', $id)->selectRaw("COUNT(*) as count, DATE_FORMAT(created_at, '%M') as month_name, MONTH(created_at) as month_number")
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("MONTH(created_at)"), DB::raw("DATE_FORMAT(created_at, '%M')"))
            ->orderBy(DB::raw("MONTH(created_at)"))
            ->get();

        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $data = array_fill(0, 12, 0);

        foreach ($ordergraph as $item) {
            $monthIndex = $item->month_number - 1;
            $data[$monthIndex] = $item->count;
        }

        $transfer_history = Transfer::latest()
            ->with('seller')
            ->where('seller_id', Auth::user()->id) // Eager load the seller relationship
            ->paginate($limit);

        $ttl = $transfer_history->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('seller.index', compact('labels', 'data', 'transfer_history', 'revenue', 'order', 'pending', 'product', 'ttl', 'ttlpage'));
    }


    public function profile()
    {
        $user = Auth::user();
        $countries = Country::latest()->get();
        $id = $user->created_by !== null ? $user->created_by : $user->id;
        $data = Seller::where('user_id', $id)->first();
        return view('seller.profile', compact('user', 'data', 'countries'));
    }


    public function storeProfile(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);

        $img = $request->file('photo');
        if ($img) {
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('images'), $filename);
            $data->user_photo = $filename;
        }

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->password !== $data->password) {
            $data->password = Hash::make($request->password);
        }

        $data->save();
        $msg = ('Data updated successfully');
        return redirect('/profile')->with('success', $msg);
    }



    public function updateShop(Request $request)
    {
        $old_img = $request->old_img;
        $id = $request->seller_id;
        $seller = Seller::find($id);

        $request->validate([
            'shop_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'prefecture' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'chome' => 'required|string|max:255',
            'building' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'bank_branch' => 'required|string|max:255',
            'bank_acc_type' => 'required|string|max:255',
            'bank_acc_name' => 'required|string|max:255',
            'bank_acc_no' => 'required|string|max:255',
            'shop_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('shop_logo')) {
            if (File::exists($old_img)) {
                File::delete($old_img);
            }
            $img = $request->file('shop_logo');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('images'), $filename);
        } else {
            $filename = $old_img;
        }

        $seller->country_id = $request->country_id;
        $seller->shop_name = $request->shop_name;
        $seller->shop_logo = $filename;
        $seller->shop_establish = $request->shop_establish;
        $seller->phone = $request->phone;
        $seller->zip_code = $request->zip_code;
        $seller->prefecture = $request->prefecture;
        $seller->city = $request->city;
        $seller->chome = $request->chome;
        $seller->building = $request->building;
        $seller->room = $request->room;
        $seller->url = $request->url;
        $seller->bank_name = $request->bank_name;
        $seller->bank_branch = $request->bank_branch;
        $seller->bank_acc_type = $request->bank_acc_type;
        $seller->bank_acc_name = $request->bank_acc_name;
        $seller->bank_acc_no = $request->bank_acc_no;
        $seller->updated_at = Carbon::now();
        $seller->update();

        $msg = ('Data updated successfully');
        return redirect('/profile')->with('success', $msg);
    }



    public function help()
    {
        $limit = 10;
        $validated = request()->validate([
            'search' => 'string|nullable',
        ]);

        $search = $validated['search'] ?? null;
        $userEmail = Auth::user()->email;
        $receivedQuery = Help::where('to', $userEmail)
            ->select('helps.*')
            ->join(DB::raw('(SELECT MAX(id) as id FROM helps WHERE `to` = "' . $userEmail . '" GROUP BY subject) as latest_help'), function ($join) {
                $join->on('helps.id', '=', 'latest_help.id');
            });
        $sentQuery = Help::where('from', $userEmail)
            ->select('helps.*')
            ->join(DB::raw('(SELECT MAX(id) as id FROM helps WHERE `from` = "' . $userEmail . '" GROUP BY subject) as latest_help'), function ($join) {
                $join->on('helps.id', '=', 'latest_help.id');
            });
        if ($search) {
            $receivedQuery->where(function ($q) use ($search) {
                $q->where('to', 'LIKE', "%{$search}%")
                    ->orWhere('from', 'LIKE', "%{$search}%")
                    ->orWhere('subject', 'LIKE', "%{$search}%")
                    ->orWhere('body', 'LIKE', "%{$search}%");
            });

            $sentQuery->where(function ($q) use ($search) {
                $q->where('to', 'LIKE', "%{$search}%")
                    ->orWhere('from', 'LIKE', "%{$search}%")
                    ->orWhere('subject', 'LIKE', "%{$search}%")
                    ->orWhere('body', 'LIKE', "%{$search}%");
            });
        }

        $received = $receivedQuery->orderBy('created_at', 'desc')->paginate($limit);
        $sent = $sentQuery->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $received->total();
        $ttlpage = ceil($ttl / $limit);
        $sentttl = $sent->total();
        $sentttlpage = ceil($sentttl / $limit);

        return view('seller.help.help', compact('received', 'sent', 'ttl', 'ttlpage', 'sentttl', 'sentttlpage'));
    }

    public function detailHelp($id)
    {
        $start = Help::find($id);
        if ($start) {
            $reply = Help::where('help_id', $start->help_id)->where('subject', $start->subject)->get();
        } else {
            $reply = null;
        }

        return view('seller.help.help_detail', compact('start', 'reply'));
    }

    public function addHelp()
    {
        return view('seller.help.help_add');
    }

    public function storeHelp(Request $request)
    {
        // $validatedData = $request->validate([
        //     'subject' => 'present|string|max:255',
        //     'body' => 'present|string|max:255',
        // ]);
        $help = new Help();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }

        $shopName = Seller::where('user_id', Auth::user()->id)->value('shop_name');
        $help->name = Auth::user()->name;
        $help->shop_name = $shopName;
        $help->help_id = Auth::user()->id;
        $help->to = 'admin@asia-hd.com';
        $help->from = Auth::user()->email;
        $help->subject = $request->title;
        $help->body =  $request->message;

        $help->img =   $imageName;

        $help->created_at = Carbon::now();
        $help->save();

        $helpDate = Carbon::now()->format('M d, Y');

        $adminemail = 'admin@asia-hd.com';
        $data = [
            'title' => $request->title,
            'content' => $request->message,
            'imgName' => $imageName,

            'helpDate' => $helpDate,
            'selleremail' => Auth::user()->email
        ];
        \Mail::to($adminemail)->send(new \App\Mail\SellerContact($data));

        Notification::create([
            'related_id' => $help->id,
            'message' => 'A new contact added:',
            'time' => Carbon::now(),
            'seen' => 0,
        ]);

        $msg = ('Data sent successfully');
        return redirect('/help')->with('success', $msg);
    }


    public function reply($id)
    {
        $getId = Help::find($id);
        $helpId = $getId->help_id;
        $data = Help::where(function ($query) use ($helpId) {
            $query->where('help_id', $helpId)
                ->orWhere('id', $helpId);
        })->get();
        return view('seller.help.help_reply', compact('data'));
    }


    public function storeReply(Request $request)
    {
        $help = new Help();

        if (!empty($request->image)) {
            $img = $request->image;
            $imageName = time() . '.' . $img->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }

        $shopName = Seller::where('user_id', Auth::user()->id)->value('shop_name');
        $check = Help::find($request->id);
        $help->help_id = $check->help_id;
        $help->name = Auth::user()->name;
        $help->to = $check->to == Auth::user()->email ? $check->from : $check->to;
        $help->from = Auth::user()->email;
        $help->shop_name = $shopName;
        $help->subject = $check->subject;
        $help->body = $request->body;
        $help->img = $imageName;
        $help->updated_at = Carbon::now();
        $help->save();

        $helpDate = Carbon::now()->format('M d, Y');
        $adminemail = $help->to;
        $data = [
            'title' => $check->subject,
            'content' => $request->body,
            'imgName' => $imageName,
            'helpDate' => $helpDate,
            'selleremail' => Auth::user()->email
        ];
        \Mail::to($adminemail)->send(new \App\Mail\SellerContact($data));

        Notification::create([
            'related_id' => $help->id,
            'message' => 'A new contact added:',
            'time' => Carbon::now(),
            'seen' => 0,
        ]);

        $msg = ('Data sent successfully');
        return redirect('/help')->with('success', $msg);
    }


    public function deleteHelp(Request $request)
    {
        $id = $request->id;
        $help = Help::findOrFail($id);
        $imagePath = public_path('images' . $help->img);
        $help->delete();
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $msg = ('Data deleted successfully');
        return back()->with('success', $msg);
    }



    public function allSubseller()
    {
        $validated = request()->validate([
            'search' => 'string|nullable',
        ]);

        $search = $validated['search'] ?? null;
        $id = Auth::user()->id;
        $query =  User::where('created_by', $id);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $subseller = $query->latest()->get();
        return view('seller.subseller.subseller_all', compact('subseller'));
    }



    public function addSubseller()
    {
        $id = Auth::user()->id;
        $seller =  Seller::where('user_id', $id)->latest()->first();;
        return view('seller.subseller.subseller_add', compact('seller'));
    }


    public function storeSubseller(Request $request)
    {
        $time = new Datetime();
        $seller_id = $request->seller_id;
        $validatedData = $request->validate([
            'user_name' => 'present|string|max:255',
            'mail' => 'present|string|email|max:255|unique:users,email',
            'passwords' => 'present|string|min:8',
            'confirmed' => 'required|string|same:passwords',
        ]);

        $user = User::create([
            'name' => $validatedData['user_name'],
            'email' => $validatedData['mail'],
            'role' => 'seller',
            'password' => Hash::make($validatedData['passwords']),
            'phone' => $request->input('phone'),
            'email_verified_at' => $time->format('Y-m-d H:i:s'),
            'status' => 1,
        ]);

        $subseller = Subseller::create([
            'user_id' => $user->id,
            'seller_id' => Auth::user()->id,
            'name' => $validatedData['user_name'],
            'email' => $validatedData['mail'],
            'password' => Hash::make($validatedData['passwords']),
            'phone' => $request->input('phone'),
        ]);

        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            \Mail::to($admin->email)->send(new \App\Mail\AdminNewMemberRegistration($user, $admin));
        }

        $createdBy = Seller::where('user_id', $user->created_by)->first();
        Notification::create([
            'related_id' => $user->id,
            'message' => 'A new sub seller added by ' . $createdBy->shop_name . ':',
            'time' => Carbon::now(),
            'seen' => 0,
        ]);

        $msg = ('Data added successfully');
        return redirect('/subsellerlist')->with('success', $msg);
    }


    public function deleteSubseller(Request $request)
    {
        $id = $request->id;
        User::where('id', $id)->delete();
        Subseller::where('id', $id)->delete();
        $msg = ('Subseller deleted successfully');
        return back()->with('success', $msg);
    }

    public function markAsSeen($id)
    {
        $notification = SellerNotification::find($id);
        if ($notification) {
            $notification->seen = 1;
            $notification->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function allSeen()
    {
        SellerNotification::where('seen', 0)->update(['seen' => 1]);
        return redirect()->back();
    }
}