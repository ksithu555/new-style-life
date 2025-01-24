<?php

namespace App\Http\Controllers;

use Mail;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Buyer;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Seller;
use App\Models\Payment;
use App\Models\Process;
use App\Models\Product;
use App\Models\Prefecture;
use App\Models\BankAccount;
use App\Models\OrderDetail;
use App\Models\BuyerAddress;
use App\Models\BuyerPayment;
use App\Models\CouponDetail;
use App\Models\Notification;
use App\Models\SellerNotification;
use Illuminate\Http\Request;
use App\Http\Middleware\Role;
use Illuminate\Http\Response;
use App\Models\CashBankAccount;
use App\Models\UserNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{

    public function index()
    {

        $prefecture = Prefecture::get();
        return view('front-end.user-register', compact('prefecture'));
    }

    //for new user registration for login
    public function store(Request $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return back()->withErrors(['email' => __('messages.email_already_exists_error_message')])->withInput();
        }

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role' => 'buyer',
                'password' => Hash::make($request->input('password')),
                'status' => '1',
            ]);

            $buyer = Buyer::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'email' => $user->email,
                'phone' => $request->phone,
            ]);

            $buyerAddress = BuyerAddress::create([
                'buyer_id' => $buyer->id,
                'name' => $request->name,
                'post_code' => $request->zip_code,
                'prefecture_id' => $request->prefecture,
                'city' => $request->city,
                'chome' => $request->chome,
                'building' => $request->building,
                'room_no' => $request->room,
                'phone' => $request->phone,
                'place' => "HOME",
                'default' => 1,
                'main_address' => 1
            ]);
            DB::commit();

            event(new Registered($user));
            // event(new Registered($buyer));

            Notification::create([
                'related_id' => $user->id,
                'message' => 'A new user added:',
                'time' => Carbon::now(),
                'seen' => 0,
            ]);

            return view('auth.buyer-verify-email', compact('user'));
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
        }
    }
    public function indexuser()
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();

        if (Auth::check()) {
            $address = BuyerAddress::join('buyers', 'buyers.id', 'buyer_addresses.buyer_id')
                ->where('user_id', $user->id)->where('buyer_addresses.main_address', 1)->first();

            $profile = route('user_profile');

            $buyer = DB::table('buyers')->where('user_id', Auth::user()->id)->first();
            $orderCount = Order::where('buyer_id', $buyer->id)->count();

            $orderDetails = OrderDetail::where('buyer_id', $buyer->id)->get();
            $countForPending = [];
            foreach ($orderDetails as $orderDetail) {
                if (!isset($countForPending[$orderDetail->order_id])) {
                    $countForPending[$orderDetail->order_id] = 1;
                }

                if (is_null($orderDetail->delivered_date)) {
                    $countForPending[$orderDetail->order_id] = 0;
                }
            }
            $pendingCount = array_sum($countForPending);

            $wishlist = DB::table('wishlists')
                ->join('buyers', 'wishlists.buyer_id', '=', 'buyers.id')
                ->where('buyers.user_id', Auth::user()->id)
                ->select('wishlists.*', 'buyers.*')

                ->get();

            $wishlistCount = $wishlist->count();

            return view('front-end.user-dashboard', compact(
                'user',
                'address',
                'profile',
                'orderCount',
                'wishlistCount',
                'pendingCount'
            ));
        } else {
            return redirect()->route('login');
        }
    }
    //Show Orders
    public function showOrders(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $limit = 10;

            $orders = DB::table('orders')
                ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
                ->where('buyers.user_id', $user->id)
                ->select('orders.*', 'orders.created_at as order_created_at', 'orders.id as order_id', 'buyers.*')
                ->orderBy('orders.created_at', 'desc')
                ->paginate($limit);

            $ttl = $orders->total();
            $ttlpage = ceil($ttl / $limit);

            return view('front-end.user-order', compact('user', 'orders', 'ttl', 'ttlpage'));
        } else {
            return redirect()->route('login');
        }
    }
    //Show Order Details
    public function showOrderDetails(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $auth = Auth::user()->id;

        $orderDetails = OrderDetail::join('orders', 'order_details.order_id', 'orders.id')
            ->join('products', 'products.id', 'order_details.product_id')
            ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
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
                'order_details.name as order_details_name',
                'order_details.phone as order_details_phone'
            )
            ->where('buyers.user_id', Auth::user()->id)
            ->where('orders.id', $request->id)
            ->get();

        return view('front-end.user-order-details', compact('orderDetails', 'user'));
    }

    public function showOrderDetailTracking(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $orderDetail = OrderDetail::with('prefecture')->with('seller')->with('seller.country')
            ->select(
                'order_details.*',
                'products.*',
                'order_details.post_code as cus_post_code',
                'order_details.city as cus_city',
                'order_details.chome as cus_chome',
                'order_details.building as cus_building',
                'order_details.room_no as cus_room',
                'order_details.created_at as order_detail_created_at'
            )
            ->leftjoin('products', 'order_details.product_id', 'products.id')
            ->where('order_details.id', $request->id)
            ->first();
        return view('front-end.user-order-detail-tracking', compact('user', 'orderDetail'));
    }
    //Show Order Tracking
    public function orderTracking(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $id = $request->id;
        $order = Order::find($id);
        $process = Process::where('order_id', $id)->latest()->get();
        $orderDetails = DB::table('order_details')
            ->join('sellers', 'order_details.seller_id', '=', 'sellers.id')
            ->join('buyers', 'order_details.buyer_id', '=', 'buyers.id')
            ->where('buyers.user_id', Auth::user()->id)
            ->where('order_details.id', $id)
            ->select('order_details.*', 'order_details.id as order_id', 'sellers.*', 'order_details.post_code as code', 'order_details.city as buyercity', 'order_details.chome as buyerchome', 'order_details.building as buyerbuilding', 'order_details.room_no as buyerroom')
            ->get();

        foreach ($orderDetails as $location) {
            $locationcity = $location->buyercity;
            $locationchome = $location->buyerchome;
        }
        return view('front-end.user-order-tracking', compact('user', 'order', 'process', 'orderDetails', 'locationcity', 'locationcity'));
    }
    //Show Delivery Status
    public function showDelistatus(Request $request)
    {
        $limit = 10;
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $buyer = Buyer::where('user_id', Auth::user()->id)->first();
        $orders = Product::leftjoin('order_details', 'products.id', 'order_details.product_id')
            ->leftjoin('orders', 'order_details.order_id', 'orders.id')
            ->where('order_details.buyer_id', $buyer->id)
            ->orderBy('orders.order_code', 'desc')
            ->paginate($limit);

        $ttl = $orders->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('front-end.user-delivery-status', compact('user', 'orders', 'ttl', 'ttlpage'));
    }
    //Show Addresses
    public function showAddresses(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $prefecture = Prefecture::get();
        $data = BuyerAddress::select('buyer_addresses.*', 'buyers.name as username', 'buyers.email as useremail',)
            ->join('buyers', 'buyer_addresses.buyer_id', '=', 'buyers.id')
            ->where('buyers.user_id', $user->id)
            ->with('prefecture')->get();

        //$user = Buyers::first();
        return view('front-end.user-address', compact('data', 'user', 'prefecture'));
    }
    //Add New Address
    public function createNewaddress(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'post_code' => 'required|string|max:255',
            'prefectures' => 'required|string|max:255|not_in:Choose Prefecture',
            'city' => 'required|string|max:255',
            'chome' => 'required|string|max:255',
            'building' => 'required|string|max:255',
            'roomno' => 'required|string|max:255',
            'place' => 'required|in:Home,Office,Other',
            'phone' => 'required|string|max:255',
        ], [
            'name.required' => 'Please provide your name.',
            'name.max' => 'Your name must not be exceed 255 characters.',
            'post_code.required' => 'Please provide your post_code.',
            'post_code.max' => 'Your post_code must not be exceed 255 characters.',
            'prefectures.required' => 'Please provide your prefecture.',
            'prefectures.max' => 'Your prefecture must not be exceed 255 characters.',
            'prefectures.not_in' => 'Please select a valid prefecture.',
            'city.required' => 'Please provide your city.',
            'city.max' => 'Your city must not be exceed 255 characters.',
            'chome.required' => 'Please provide your chome.',
            'chome.max' => 'Your chome must not be exceed 255 characters.',
            'building.required' => 'Please provide your building.',
            'building.max' => 'Your building must not be exceed 255 characters.',
            'roomno.required' => 'Please provide your roomno.',
            'roomno.max' => 'Your roomno must not be exceed 255 characters.',
            'place.in' => 'Please select a valid place.',
            'phone.required' => 'Please provide your phone number.',
            'phone.min' => 'The phone number must not be exceed 255 characters.',
        ]);
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $buyer = Buyer::where('user_id', Auth::user()->id)->first();
        $prefecture = Prefecture::get();
        $data = BuyerAddress::select('buyer_addresses.id', 'buyer_addresses.name', 'buyer_addresses.post_code', 'buyer_addresses.city', 'buyer_addresses.chome', 'buyer_addresses.building', 'buyer_addresses.room_no', 'buyer_addresses.prefecture_id', 'buyer_addresses.phone', 'buyer_addresses.place', 'buyers.id as userid', 'buyers.name as username', 'buyers.email as useremail',)
            ->join('buyers', 'buyer_addresses.buyer_id', '=', 'buyers.id')
            ->get();

        if ($request->filled('name', 'post_code', 'city', 'chome', 'building', 'roomno', 'place', 'phone')) {

            $Buyer_addresses = BuyerAddress::create([
                'buyer_id' => $buyer->id,
                'name' => $request->name,
                'post_code' => $request->post_code,
                'prefecture_id' => $request->prefectures,
                'city' => $request->city,
                'chome' => $request->chome,
                'building' => $request->building,
                'room_no' => $request->roomno,
                'place' => $request->place,
                'phone' => $request->phone,
                'default' => 0,
                'main_address' => 0,
            ]);

            if ($Buyer_addresses) {
                return redirect()->route('user_addresses', compact('data', 'user', 'prefecture'));
            } else {
                // Handle failure to save
                return back()->withInput()->withErrors(['error' => 'Failed to save address.']);
            }
        } else {
            // Handle missing data
            return back()->withInput()->withErrors(['error' => 'Missing data for address.']);
        }
    }

    //Edit Address
    public function editAddress(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $buyer = Buyer::where('user_id', Auth::user()->id)->first();
        $prefecture = Prefecture::get();

        $buyerAddress = BuyerAddress::find($request->id);

        $data = BuyerAddress::select(
            'buyer_addresses.id',
            'buyer_addresses.name',
            'buyer_addresses.post_code',
            'buyer_addresses.city',
            'buyer_addresses.chome',
            'buyer_addresses.building',
            'buyer_addresses.room_no',
            'buyer_addresses.prefecture_id',
            'buyer_addresses.phone',
            'buyer_addresses.place',
            'buyers.id as userid',
            'buyers.name as username',
            'buyers.email as useremail',
        )
            ->join('buyers', 'buyer_addresses.buyer_id', '=', 'buyers.id')
            ->get();

        if ($buyerAddress) {

            $buyerAddress->update([
                'buyer_id' => $buyer->id,
                'name' => $request->name,
                'post_code' => $request->post_code,
                'prefecture_id' => $request->prefectures,
                'city' => $request->city,
                'chome' => $request->chome,
                'building' => $request->building,
                'room_no' => $request->roomno,
                'place' => $request->place,
                'phone' => $request->phone,
            ]);
            return redirect()->route('user_addresses', compact('data', 'user', 'prefecture'));
        } else {
            // Return an error response
            return response()->json(['error' => 'Address not found'], 404);
        }
    }
    //Remove Address
    public function removeAddress($id)
    {
        $prefecture = Prefecture::get();
        $address = BuyerAddress::find($id);
        if ($address) {
            $address->delete();
            return redirect()->route('user_addresses', compact('prefecture'));
        } else {
            return back()->with('error', 'Address not found.');
        }
    }
    //Show Payment Method
    public function showCard(Request $request)
    {
        // Retrieve the encrypted account number from the database
        //$encryptedAccountNumber = $model->account_number; // Assuming $model contains the database record

        // Decrypt the account number
        //$decryptedAccountNumber = Crypt::decryptString($encryptedAccountNumber);

        // Extract the last four digits
        //$lastFourDigits = substr($decryptedAccountNumber, -4);

        // Use $lastFourDigits as needed
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $data = BuyerPayment::select('buyer_payments.*', 'buyers.id as userid', 'buyers.name as username', 'buyers.email as useremail')
            ->join('buyers', 'buyer_payments.buyer_id', '=', 'buyers.id')
            ->where('buyers.user_id', Auth::user()->id)
            ->get();
        return view('front-end.user-payment-method', compact('data', 'user'));
    }
    //Add New Card
    public function createNewcard(Request $request)
    {
        $buyer = Buyer::where('user_id', Auth::user()->id)->first();
        $validatedData = $request->validate([
            'acc_name' => 'required|string|max:255',
            'acc_no_1' => 'required|string|max:4',
            'acc_no_2' => 'required|string|max:4',
            'acc_no_3' => 'required|string|max:4',
            'acc_no_4' => 'required|string|max:4',
            'expired_date_1' => 'required|string|max:2',
            'expired_date_2' => 'required|string|max:2',
            'card_type' => 'required|in:Visa,Master,RuPay,Maestro',

        ], [
            'acc_name.required' => 'Please provide your account name.',
            'acc_name.max' => 'The account name must not exceed 255 characters.',
            'acc_no_*.required' => 'Please provide your account number.',
            'acc_no_*.max' => 'Each part of the account number must not exceed 4 characters.',
            'expired_date_*.required' => 'Please provide the expired date.',
            'expired_date_*.max' => 'Each part of the expiration date must not exceed 2 characters.',
            'card_type.required' => 'Please select a card type.',
            'card_type.in' => 'Please select a valid card type (Visa, Master, RuPay, Maestro).',
        ]);
        $acc_no = $request->acc_no_1 . $request->acc_no_2 . $request->acc_no_3 . $request->acc_no_4;
        $expired_date = $request->expired_date_1 . $request->expired_date_2;

        $Buyer_cards = BuyerPayment::create([

            'buyer_id' => $buyer->id,
            'acc_name' => $request->acc_name,
            'acc_no' => $acc_no,
            'expired_date' => $expired_date,
            'card_type' => $request->card_type,

        ]);
        $saved = $Buyer_cards->save();
        return redirect()->route('user_cards');
    }
    //Edit Card
    public function editCard(Request $request)
    {
        $buyerCard = BuyerPayment::find($request->id);

        if ($buyerCard) {

            $buyerCard->update([
                'id' => $request->id,
                'acc_name' => $request->acc_name,
                'acc_no' => $request->acc_no,
                'expired_date' => $request->expired_date,
                'card_type' => $request->card_type,

            ]);
            return redirect()->route('user_cards');
        } else {
            return response()->json(['error' => 'Address not found'], 404);
        }
    }
    //Remove Card
    public function removeCard($id)
    {
        $card = BuyerPayment::find($id);
        if ($card) {
            $card->delete();
            return back()->with('success', 'Address removed successfully.');
            return redirect()->route('user_cards');
        } else {
            return back()->with('error', 'Address not found.');
        }
    }
    //Show Profile
    public function showProfile(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $buyer = DB::table('buyers')
            ->join('users', 'buyers.user_id', '=', 'users.id')
            ->where('buyers.user_id', Auth::user()->id)
            ->select('users.*', 'buyers.*')
            ->first();
        $buyerAddress = BuyerAddress::where('buyer_id', $buyer->id)->where('main_address', 1)->first();
        $maskedPassword = str_repeat('*', strlen($user->password));
        $prefecture = Prefecture::get();
        if ($user && $buyer) {
            return view('front-end.user-profile', compact('user', 'buyer', 'buyerAddress', 'maskedPassword', 'prefecture'));
        } else {
            return redirect()->route('login');
        }
    }
    //Edit Profile
    public function editProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $buyer = Buyer::find($request->buyer_id);
        $buyerAddress = BuyerAddress::where('buyer_id', $buyer->id)->where('main_address', 1)->first();

        if ($user && $buyer && $buyerAddress) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            $buyer->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            $buyerAddress->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'post_code' => $request->post_code,
                'prefecture_id' => $request->prefectures,
                'city' => $request->city,
                'chome' => $request->chome,
                'building' => $request->building,
                'room_no' => $request->roomno,
                'place' => $request->place,
            ]);
            return redirect()->route('user_profile');
        } else {
            return response()->json(['error' => 'Profile not found'], 404);
        }
    }
    //Edit Password
    public function editPassword(Request $request)
    {
        $user = User::find(Auth::user()->id);

        // Check if the old password matches
        if (!Hash::check($request->oldpassword, $user->password)) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'oldpassword' => 'The old password is incorrect.',
                ],
            ]);
        }

        // Update the new password
        $user->password = Hash::make($request->newpassword);
        $user->save();
        \Mail::to($user->email)->send(new \App\Mail\PasswordChanged($user));

        session()->flash('success', 'Password changed successfully.');

        return response()->json([
            'success' => true,
            'message' => view('components.messagebox')->render(),
        ]);

        // return response()->json([
        //     'success' => true,
        // ]);
    }

    public function showCarts(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $productid = $request->id;

        if (isset($productid)) {
            $product = DB::table('products')->where('id', $productid)->first();
            $buyer = Buyer::where('user_id', Auth::user()->id)->first();

            if ($product)
                $cart = Cart::firstorcreate([
                    'product_id' => $product->id,
                    'seller_id' => $product->seller_id,
                    'buyer_id' => $buyer->id,
                    'quantity' => '1',
                    'size' => $request->size,
                    'color' => $request->color,
                ]);
        }

        $cartLists = DB::table('carts')
            ->leftJoin('products', 'carts.product_id', '=', 'products.id')
            ->leftJoin('buyers', 'carts.buyer_id', '=', 'buyers.id')
            ->leftJoin('sellers', 'carts.seller_id', '=', 'sellers.user_id')
            ->where('buyers.user_id', Auth::user()->id)
            ->select(
                'carts.*',
                'carts.id as cart_id',
                'buyers.*',
                'buyers.id as buyer_id',
                'carts.product_id as product_id',
                'products.*',
                DB::raw('CASE
                                    WHEN sellers.coupon_id IS NOT NULL THEN sellers.coupon_id
                                    WHEN products.coupon_id IS NOT NULL THEN products.coupon_id
                                    ELSE NULL
                                END AS coupon_id'),
                DB::raw('CASE
                                    WHEN sellers.coupon_id IS NOT NULL THEN (SELECT coupon_code FROM coupons WHERE id = sellers.coupon_id AND status = 1)
                                    WHEN products.coupon_id IS NOT NULL THEN (SELECT coupon_code FROM coupons WHERE id = products.coupon_id AND status = 1)
                                    ELSE NULL
                                END AS coupon_code')
            )
            ->get();
        $maxDeliveryPrices = [];
        foreach ($cartLists as $key => $cartItem) {
            $productID = $cartItem->id;
            $sellerID = $cartItem->seller_id;

            $shopName = DB::table('sellers')
                ->where('sellers.user_id', $sellerID)
                ->select('sellers.shop_name as shopname')
                ->first();
            $cartItem->shop_name = $shopName->shopname;

            $sellerID = $cartItem->seller_id;
            if (!isset($maxDeliveryPrices[$sellerID])) {
                $maxDeliveryPrices[$sellerID] = $cartItem->delivery_price;
            } else {
                $maxDeliveryPrices[$sellerID] = max($maxDeliveryPrices[$sellerID], $cartItem->delivery_price);
            }
        }
        $shippingFee = array_sum($maxDeliveryPrices);
        if ($shippingFee >= 5000)
            $shippingFee = 0;

        $discount = 0;
        $couponapplycheck = 0;
        return view('front-end.cart', compact('cartLists', 'discount', 'couponapplycheck', 'shippingFee', 'maxDeliveryPrices'));
    }

    public function removeCart($id)
    {
        $cartItem = DB::table('carts')
            ->delete($id);

        $cartLists = DB::table('carts')
            ->leftJoin('products', 'carts.product_id', '=', 'products.id')
            ->leftJoin('buyers', 'carts.buyer_id', '=', 'buyers.id')
            ->leftJoin('sellers', 'carts.seller_id', '=', 'sellers.user_id')
            ->where('buyers.user_id', Auth::user()->id)
            ->select(
                'carts.*',
                'carts.id as cart_id',
                'buyers.*',
                'buyers.id as buyer_id',
                'carts.product_id as product_id',
                'products.*',
                DB::raw('CASE
                                    WHEN sellers.coupon_id IS NOT NULL THEN sellers.coupon_id
                                    WHEN products.coupon_id IS NOT NULL THEN products.coupon_id
                                    ELSE NULL
                                END AS coupon_id'),
                DB::raw('CASE
                                    WHEN sellers.coupon_id IS NOT NULL THEN (SELECT coupon_code FROM coupons WHERE id = sellers.coupon_id)
                                    WHEN products.coupon_id IS NOT NULL THEN (SELECT coupon_code FROM coupons WHERE id = products.coupon_id)
                                    ELSE NULL
                                END AS coupon_code')
            )
            ->get();

        $maxDeliveryPrices = [];
        foreach ($cartLists as $key => $cartItem) {
            $productID = $cartItem->id;
            $sellerID = $cartItem->seller_id;

            $shopName = DB::table('sellers')
                ->where('sellers.user_id', $sellerID)
                ->select('sellers.shop_name as shopname')
                ->first();
            $cartItem->shop_name = $shopName->shopname;

            $sellerID = $cartItem->seller_id;
            if (!isset($maxDeliveryPrices[$sellerID])) {
                $maxDeliveryPrices[$sellerID] = $cartItem->delivery_price;
            } else {
                $maxDeliveryPrices[$sellerID] = max($maxDeliveryPrices[$sellerID], $cartItem->delivery_price);
            }
        }
        $shippingFee = array_sum($maxDeliveryPrices);
        if ($shippingFee >= 5000)
            $shippingFee = 0;

        $result = DB::table('coupons')
            ->join('coupon_details', 'coupon_details.coupon_id', '=', 'coupons.id')
            ->join('buyers', 'coupon_details.buyer_id', '=', 'buyers.id')
            ->select('coupons.discount_amount')
            ->pluck('coupons.discount_amount');
        $discount = 0;
        $couponapplycheck = 0;
        return view('front-end.cart', compact('cartLists', 'discount', 'couponapplycheck', 'shippingFee', 'maxDeliveryPrices'));
    }
    public function removeCartProduct($id)
    {
        $buyer = Buyer::where('user_id', Auth::user()->id)->first();
        $cartItem = Cart::where('buyer_id', $buyer->id)->where('product_id', $id)->first();
        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['message' => 'Cart item deleted successfully']);
        } else {
            return response()->json(['message' => 'Cart item not found'], 404);
        }
    }
    //Update Cart Quantity
    public function updateCartQty(Request $request, $id)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $quantity = $request->input('quantity');
        $cartItem = Cart::find($id);
        $couponapplycheck = 0;

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();

            $cartLists = DB::table('carts')
                ->leftJoin('products', 'carts.product_id', '=', 'products.id')
                ->leftJoin('buyers', 'carts.buyer_id', '=', 'buyers.id')
                ->leftJoin('sellers', 'carts.seller_id', '=', 'sellers.user_id')
                ->where('buyers.user_id', Auth::user()->id)
                ->select(
                    'carts.*',
                    'carts.id as cart_id',
                    'buyers.*',
                    'buyers.id as buyer_id',
                    'carts.product_id as product_id',
                    'products.*',
                    DB::raw('CASE
                                            WHEN sellers.coupon_id IS NOT NULL THEN sellers.coupon_id
                                            WHEN products.coupon_id IS NOT NULL THEN products.coupon_id
                                            ELSE NULL
                                        END AS coupon_id'),
                    DB::raw('CASE
                                            WHEN sellers.coupon_id IS NOT NULL THEN (SELECT coupon_code FROM coupons WHERE id = sellers.coupon_id)
                                            WHEN products.coupon_id IS NOT NULL THEN (SELECT coupon_code FROM coupons WHERE id = products.coupon_id)
                                            ELSE NULL
                                        END AS coupon_code')
                )
                ->get();

            $maxDeliveryPrices = [];
            foreach ($cartLists as $key => $cartItem) {
                $productID = $cartItem->id;
                $sellerID = $cartItem->seller_id;

                $shopName = DB::table('sellers')
                    ->where('sellers.user_id', $sellerID)
                    ->select('sellers.shop_name as shopname')
                    ->first();
                $cartItem->shop_name = $shopName->shopname;

                $sellerID = $cartItem->seller_id;
                if (!isset($maxDeliveryPrices[$sellerID])) {
                    $maxDeliveryPrices[$sellerID] = $cartItem->delivery_price;
                } else {
                    $maxDeliveryPrices[$sellerID] = max($maxDeliveryPrices[$sellerID], $cartItem->delivery_price);
                }
            }
            $shippingFee = array_sum($maxDeliveryPrices);
            if ($shippingFee >= 5000)
                $shippingFee = 0;

            $result = DB::table('coupons')
                ->join('coupon_details', 'coupon_details.coupon_id', '=', 'coupons.id')
                ->join('buyers', 'coupon_details.buyer_id', '=', 'buyers.id')
                ->select('coupons.discount_amount')
                ->pluck('coupons.discount_amount');
            $discount = $result[0];
        }
        return response()->json([
            'message' => 'Quantity updated successfully.',
            'redirect_url' => route('show_carts', compact('cartLists', 'discount', 'couponapplycheck', 'shippingFee'))
        ]);

        // return response()->json(['message' => 'Cart item added successfully']);

    }

    //Product Cupon
    public function applyCouponCode(Request $request)
    {
        $coupon = Coupon::where('coupon_code', $request->coupon)
            ->where('status', 1)->first();
        if (!$coupon) {
            $refreshCart = 'Invalid Coupon Code. Please try again!';
            return redirect()->back()->with(compact('refreshCart'));
        } else {
            $couponCountCheck = CouponDetail::where('coupon_id', $coupon->id)->count();
            if ($couponCountCheck >= $coupon->valid_count) {
                $refreshCart = "The coupon (" . $request->coupon . ") has reached its maximum usage limit.";
                return redirect()->back()->with(compact('refreshCart'));
            }
            if ($coupon->startdate > Carbon::now()->endOfDay()) {
                $refreshCart = "The coupon (" . $request->coupon . ") cannot be used until " . date('Y/m/d', strtotime($coupon->startdate)) . ".";
                return redirect()->back()->with(compact('refreshCart'));
            }
            if ($coupon->enddate < Carbon::now()->startOfDay()) {
                $refreshCart = "This coupon (" . $request->coupon . ") is already expired.";
                return redirect()->back()->with(compact('refreshCart'));
            }
            $buyer = Buyer::where('user_id', Auth::user()->id)->first();
            $cartLists = Cart::with('product')->with('buyer')->with('seller')
                ->where('buyer_id', $buyer->id)->get();
            $cartSellerTotalAmount = [];
            $couponUsedSeller = 0;
            $couponUsedSellerName = "";
            $couponUsedProduct = 0;
            foreach ($cartLists as $cart) {
                if ($cart->seller->coupon_status == 1 && $cart->seller->coupon_id == $coupon->id) {
                    $couponUsedSeller = $cart->seller_id;
                    $couponUsedSellerName = $cart->seller->shop_name;
                } else if ($cart->product->coupon_status == 1 && $cart->product->coupon_id == $coupon->id) {
                    $couponUsedProduct = $cart->product_id;
                }
                if (!isset($cartSellerTotalAmount[$cart->seller_id])) {
                    $cartSellerTotalAmount[$cart->seller_id] = $cart->quantity * $cart->product->selling_price;
                } else {
                    $cartSellerTotalAmount[$cart->seller_id] += $cart->quantity * $cart->product->selling_price;
                }
            }
            if ($couponUsedSeller == 0 && $couponUsedProduct == 0) {
                $refreshCart = 'Invalid Coupon Code. Please use the displayed coupon code!';
                return redirect()->back()->with(compact('refreshCart'));
            } else if ($couponUsedSeller != 0 && $cartSellerTotalAmount[$couponUsedSeller] < $coupon->mini_amount) {
                $refreshCart = 'To use coupon (' . $request->coupon . '), minimum order is ¥'
                    . $coupon->mini_amount . ' at ' . $couponUsedSellerName . '. Please try again!';
                return redirect()->back()->with(compact('refreshCart'));
            }
            $discount = $coupon->discount_amount;
            $couponId = $coupon->id;
            return redirect()->back()->with(compact('discount', 'couponUsedSeller', 'couponUsedProduct', 'couponId'));
        }
    }

    //Product Checkout
    public function showCheckout(Request $request)
    {
        // for the updated cart check
        $realCart = Cart::leftjoin('buyers', 'buyers.id', 'carts.buyer_id')
            ->where('buyers.user_id', Auth::user()->id)->get();
        if ($realCart->count() != count($request->product)) {
            $refreshCart = 'Updated your cart. Please try again!';
            return redirect()->back()->with(compact('refreshCart'));
        }

        // for the instock check
        $instockCheck = [];
        foreach ($request->product as $key => $prod) {
            $checkInstockProduct = Product::where('id', $prod)->first();
            if ($checkInstockProduct->in_stock < $request->quantity[$key]) {
                $instockCheck[] = $checkInstockProduct->id;
            }
        }
        if ($instockCheck) {
            $refreshCart = 'Please adjust your order quantity!';
            return redirect()->back()->with(compact('refreshCart', 'instockCheck'));
        }

        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $subTotal = $request->subTotal;
        $couponDiscount = $request->coupon_discount;
        $shippingFee = $request->shipping;
        $total1 = $request->total;
        $shop = $request->shop;
        $maxDeli = $request->maxDeli;
        $couponUsedSellerId = 0;
        $couponUsedProductId = 0;
        $couponId = 0;
        if (isset($request->coupon_used_seller_id))
            $couponUsedSellerId = $request->coupon_used_seller_id;
        if (isset($request->coupon_used_product_id))
            $couponUsedProductId = $request->coupon_used_product_id;
        if (isset($request->coupon_id))
            $couponId = $request->coupon_id;

        $buyerAddress = BuyerAddress::select('buyer_addresses.*', 'buyers.name as username', 'buyers.email as useremail',)
            ->join('buyers', 'buyer_addresses.buyer_id', '=', 'buyers.id')
            ->where('buyers.user_id', Auth::user()->id)
            ->with('prefecture')->get();

        $buyerPayment = BuyerPayment::select('buyer_payments.id', 'buyer_payments.acc_name', 'buyer_payments.acc_no', 'buyer_payments.card_type', 'buyer_payments.expired_date', 'buyer_payments.security_code', 'buyer_payments.img', 'buyers.id as userid', 'buyers.name as username', 'buyers.email as useremail')
            ->join('buyers', 'buyer_payments.buyer_id', '=', 'buyers.id')
            ->where('buyers.user_id', Auth::user()->id)
            ->get();

        $cartLists = DB::table('carts')
            ->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->where('buyers.user_id', Auth::user()->id)
            ->select('carts.*', 'carts.id as cart_id', 'buyers.*', 'buyers.id as buyer_id', 'carts.product_id as product_id', 'products.*')
            ->get();

        foreach ($cartLists as $cartItem) {

            $productID = $cartItem->id;
            $sellerID = $cartItem->seller_id;


            $shopName = DB::table('sellers')
                ->where('sellers.user_id', $sellerID)
                ->select('sellers.shop_name as shopname')
                ->first();
            $cartItem->shop_name = $shopName->shopname;
        }

        $bankAccounts = BankAccount::all();

        return view('front-end.checkout', compact(
            'buyerAddress',
            'buyerPayment',
            'cartLists',
            'subTotal',
            'couponDiscount',
            'shippingFee',
            'total1',
            'shop',
            'maxDeli',
            'couponUsedSellerId',
            'couponUsedProductId',
            'couponId',
            'bankAccounts'
        ));
    }
    //Purchase
    public function paymentCompleted(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();

        DB::beginTransaction();
        try {
            $productIds = $request->productid;
            $buyerId = $request->buyerid;
            $sellerId = $request->sellerid;
            $colors = $request->color;
            $sizes = $request->size;
            $quantities = $request->quantity;
            $productamounts = $request->productamount;
            $totalQty = $request->totalqty;
            $amount = $request->amount;
            $amount1 = $request->amount1;
            $totalAmount = $request->totalamount;
            $subTotalAmount = $request->subtotalamount;
            $shippingFee = $request->shippingfee;
            $couponDiscountAmount = $request->coupondiscountamount;
            $buyerAddressId = $request->buyeraddressid;
            $buyerAddressFirst = BuyerAddress::find($buyerAddressId);
            $name = $buyerAddressFirst->name;
            $phone = $buyerAddressFirst->phone;
            $prefectureId = $buyerAddressFirst->prefecture_id;
            $postcode = $buyerAddressFirst->post_code;
            $city = $buyerAddressFirst->city;
            $chome = $buyerAddressFirst->chome;
            $building = $buyerAddressFirst->building;
            $room = $buyerAddressFirst->room_no;
            $payment = $request->payment;
            $shopIds = $request->shopIds;
            $maxDelis = $request->maxDelis;
            $couponUsedSellerId = $request->couponUsedSellerId;
            $couponUsedProductId = $request->couponUsedProductId;
            $couponId = $request->couponId;

            $paymentApproved = ($payment === 'Cash') ? 0 : 1;

            // return response()->json(['message' => $postcode.",".$city.",".$chome.",".$building.",".$room]);


            // Generate a unique order code
            //$id = IdGenerator::generate(['table' => 'orders', 'length' => 10, 'prefix' => date('yd')]);

            $datePrefix = date('ym');
            $latestOrder = Order::where('order_code', 'like', $datePrefix . '%')->latest()->first();
            $sequentialNumber = 1;
            if ($latestOrder) {
                $latestOrderCode = $latestOrder->order_code;
                $sequentialNumber = intval(substr($latestOrderCode, strlen($datePrefix))) + 1;
            }
            $newOrderCode = $datePrefix . str_pad($sequentialNumber, 6, '0', STR_PAD_LEFT);

            $order = Order::create([
                'order_code' => $newOrderCode,
                'buyer_id' => (int)$buyerId,
                'total_amount' => $totalAmount,
                'sub_total_amount' => $subTotalAmount,
                'coupon_discount_amount' => $couponDiscountAmount,
                'coupon_used_seller_id' => $couponUsedSellerId,
                'coupon_used_product_id' => $couponUsedProductId,
                'shipping_fee' => $shippingFee,
                'total_qty' => $totalQty,
                'payment_type' => $payment,
                'payment_approved' => $paymentApproved,
            ]);

            if ($couponId != 0) {
                CouponDetail::create([
                    'buyer_id' => (int)$buyerId,
                    'coupon_id' => $couponId,
                    'order_id' => $order->id
                ]);
                $couponCheck = Coupon::where('id', $couponId)->first();
                $couponDetailCheck = CouponDetail::where('coupon_id', $couponId)->get();
                $couponCheck->used_count = $couponDetailCheck->count();
                $couponCheck->save();
                if ($couponDetailCheck->count() >= $couponCheck->valid_count) {
                    $couponCheck->status = 0;
                    $couponCheck->save();
                }
            }

            Payment::create([
                'order_id' => $order->id,
                'seller_id' => (int)$sellerId,
                'buyer_id' => (int)$buyerId,
                'total_amount' => $totalAmount,
                'payment_method' => $payment
            ]);

            foreach ($productIds as $key => $product_id) {
                $orderedProduct = Product::where('id', $product_id)->first();
                $cart = Cart::where('product_id', $product_id)->where('buyer_id', $buyerId)->first();
                $usedDeliStatus = 0;
                $usedShopCouponStatus = 0;
                $usedProductCouponStatus = 0;
                foreach ($shopIds as $shopKey => $shopId) {
                    if ($orderedProduct->seller_id == $shopId && $orderedProduct->delivery_price == $maxDelis[$shopKey]) {
                        $usedDeliStatus = 1;
                        unset($shopIds[$shopKey]);
                        unset($maxDelis[$shopKey]);
                        $shopIds = array_values($shopIds);
                        $maxDelis = array_values($maxDelis);
                        break;
                    }
                }
                if ($order->coupon_used_seller_id == $sellerId[$key])
                    $usedShopCouponStatus = 1;
                if ($order->coupon_used_product_id == (int)$product_id)
                    $usedProductCouponStatus = 1;

                $orderdetailsData = [
                    'order_id' => $order->id,
                    'buyer_id' => (int)$buyerId,
                    'seller_id' => $sellerId[$key],
                    'product_id' => (int)$product_id,
                    'prefecture_id' => $prefectureId,
                    'color' => $cart->color,
                    'size' => $cart->size,
                    'qty' => $quantities[$key],
                    'price' => $orderedProduct->selling_price,
                    'delivery_price' => $orderedProduct->delivery_price,
                    'used_delivery_price' => $usedDeliStatus,
                    'used_shop_coupon_status' => $usedShopCouponStatus,
                    'used_product_coupon_status' => $usedProductCouponStatus,
                    'payment_approved' => $paymentApproved,
                    'amount' => $productamounts[$key],
                    'commission' => $orderedProduct->commission,
                    'commission_amount' => floor($productamounts[$key] * ($orderedProduct->commission / 100)),
                    'transfer_status' => 0,
                    'name' => $name,
                    'phone' => $phone,
                    'post_code' => $postcode,
                    'city' => $city,
                    'chome' => $chome,
                    'building' => $building,
                    'room_no' => $room,
                ];
                OrderDetail::create($orderdetailsData);

                $productForInStock = Product::find($product_id);
                $productForInStock->in_stock = $productForInStock->product_qty - $quantities[$key];
                $productForInStock->save();
            }
            $cartItem = DB::table('carts')->where('buyer_id', $buyerId)
                ->delete();

            DB::commit();
            $orderDetails = OrderDetail::with('order')->with('buyer')->with('seller')
                ->where('buyer_id', $buyerId)->where('order_id', $order->id)->get();
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                \Mail::to($admin->email)->send(new \App\Mail\AdminOrderReceived($orderDetails, $admin));
            }

            $sellerIds = $orderDetails->pluck('seller_id')->unique();
            $sellers = User::whereIn('id', $sellerIds)->orWhereIn('created_by', $sellerIds)->get();
            foreach ($sellers as $seller) {
                if ($seller->created_by) {
                    $orderDetails = OrderDetail::with('order')->with('buyer')->with('seller')
                        ->where('buyer_id', $buyerId)->where('order_id', $order->id)
                        ->where('seller_id', $seller->created_by)->get();
                } else {
                    $orderDetails = OrderDetail::with('order')->with('buyer')->with('seller')
                        ->where('buyer_id', $buyerId)->where('order_id', $order->id)
                        ->where('seller_id', $seller->id)->get();
                }
                \Mail::to($seller->email)->send(new \App\Mail\SellerOrderReceived($orderDetails, $seller));
            }

            Notification::create([
                'related_id' => $order->id,
                'message' => 'A new order added:',
                'time' => Carbon::now(),
                'seen' => 0,
            ]);

            foreach ($sellerId as $seller_id) {
                SellerNotification::create([
                    'seller_id' => $seller_id,
                    'related_id' => $order->id,
                    'message' => 'A new order added:',
                    'time' => Carbon::now(),
                    'seen' => 0,
                ]);
            }

            return response()->json([
                'message' => 'Your order has been successfully placed.', 'orderId' => $order->id
            ]);
        } catch (\Exception $e) {
            // Log any exceptions for debugging
            DB::rollBack();
            // Log the exception for debugging
            Log::error('Order placement failed: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    public function cashPayment(Request $request)
    {
        DB::beginTransaction();
        try {
            $productIds = $request->productid;
            $buyerId = $request->buyerid;
            $sellerId = $request->sellerid;
            $colors = $request->color;
            $sizes = $request->size;
            $quantities = $request->quantity;
            $productamounts = $request->productamount;
            $totalQty = $request->totalqty;
            $amount = $request->amount;
            $amount1 = $request->amount1;
            $totalAmount = $request->totalamount;
            $subTotalAmount = $request->subtotalamount;
            $shippingFee = $request->shippingfee;
            $couponDiscountAmount = $request->coupondiscountamount;
            $buyerAddressId = $request->buyeraddressid;
            $buyerAddressFirst = BuyerAddress::find($buyerAddressId);
            $name = $buyerAddressFirst->name;
            $phone = $buyerAddressFirst->phone;
            $prefectureId = $buyerAddressFirst->prefecture_id;
            $postcode = $buyerAddressFirst->post_code;
            $city = $buyerAddressFirst->city;
            $chome = $buyerAddressFirst->chome;
            $building = $buyerAddressFirst->building;
            $room = $buyerAddressFirst->room_no;
            $payment = $request->payment;
            $shopIds = $request->shopIds;
            $maxDelis = $request->maxDelis;
            $couponUsedSellerId = $request->couponUsedSellerId;
            $couponUsedProductId = $request->couponUsedProductId;
            $couponId = $request->couponId;
            $bankAccountId = $request->bankAccount;
            $transferPersonName = $request->transferPersonName;
            $transferDate = $request->transferDate;

            $paymentApproved = ($payment === 'Cash') ? 0 : 1;

            $datePrefix = date('ym');
            $latestOrder = Order::where('order_code', 'like', $datePrefix . '%')->latest()->first();
            $sequentialNumber = 1;
            if ($latestOrder) {
                $latestOrderCode = $latestOrder->order_code;
                $sequentialNumber = intval(substr($latestOrderCode, strlen($datePrefix))) + 1;
            }
            $newOrderCode = $datePrefix . str_pad($sequentialNumber, 6, '0', STR_PAD_LEFT);

            $order = Order::create([
                'order_code' => $newOrderCode,
                'buyer_id' => (int)$buyerId,
                'total_amount' => $totalAmount,
                'sub_total_amount' => $subTotalAmount,
                'coupon_discount_amount' => $couponDiscountAmount,
                'coupon_used_seller_id' => $couponUsedSellerId,
                'coupon_used_product_id' => $couponUsedProductId,
                'shipping_fee' => $shippingFee,
                'total_qty' => $totalQty,
                'payment_type' => $payment,
                'payment_approved' => $paymentApproved,
            ]);

            CashBankAccount::create([
                'order_id' => $order->id,
                'transfer_person_name' => $transferPersonName,
                'transfer_date' => $transferDate,
                'bank_account_id' => $bankAccountId
            ]);

            if ($couponId != 0) {
                CouponDetail::create([
                    'buyer_id' => (int)$buyerId,
                    'coupon_id' => $couponId,
                    'order_id' => $order->id
                ]);
                $couponCheck = Coupon::where('id', $couponId)->first();
                $couponDetailCheck = CouponDetail::where('coupon_id', $couponId)->get();
                $couponCheck->used_count = $couponDetailCheck->count();
                $couponCheck->save();
                if ($couponDetailCheck->count() >= $couponCheck->valid_count) {
                    $couponCheck->status = 0;
                    $couponCheck->save();
                }
            }

            Payment::create([
                'order_id' => $order->id,
                'seller_id' => (int)$sellerId,
                'buyer_id' => (int)$buyerId,
                'total_amount' => $totalAmount,
                'payment_method' => $payment
            ]);

            foreach ($productIds as $key => $product_id) {
                $orderedProduct = Product::where('id', $product_id)->first();
                $cart = Cart::where('product_id', $product_id)->where('buyer_id', $buyerId)->first();
                $usedDeliStatus = 0;
                $usedShopCouponStatus = 0;
                $usedProductCouponStatus = 0;
                foreach ($shopIds as $shopKey => $shopId) {
                    if ($orderedProduct->seller_id == $shopId && $orderedProduct->delivery_price == $maxDelis[$shopKey]) {
                        $usedDeliStatus = 1;
                        unset($shopIds[$shopKey]);
                        unset($maxDelis[$shopKey]);
                        $shopIds = array_values($shopIds);
                        $maxDelis = array_values($maxDelis);
                        break;
                    }
                }
                if ($order->coupon_used_seller_id == $sellerId[$key])
                    $usedShopCouponStatus = 1;
                if ($order->coupon_used_product_id == (int)$product_id)
                    $usedProductCouponStatus = 1;

                $orderdetailsData = [
                    'order_id' => $order->id,
                    'buyer_id' => (int)$buyerId,
                    'seller_id' => $sellerId[$key],
                    'product_id' => (int)$product_id,
                    'prefecture_id' => $prefectureId,
                    'color' => $cart->color,
                    'size' => $cart->size,
                    'qty' => $quantities[$key],
                    'price' => $orderedProduct->selling_price,
                    'delivery_price' => $orderedProduct->delivery_price,
                    'used_delivery_price' => $usedDeliStatus,
                    'used_shop_coupon_status' => $usedShopCouponStatus,
                    'used_product_coupon_status' => $usedProductCouponStatus,
                    'payment_approved' => $paymentApproved,
                    'amount' => $productamounts[$key],
                    'commission' => $orderedProduct->commission,
                    'commission_amount' => floor($productamounts[$key] * ($orderedProduct->commission / 100)),
                    'transfer_status' => 0,
                    'name' => $name,
                    'phone' => $phone,
                    'post_code' => $postcode,
                    'city' => $city,
                    'chome' => $chome,
                    'building' => $building,
                    'room_no' => $room,
                ];
                OrderDetail::create($orderdetailsData);

                $productForInStock = Product::find($product_id);
                $productForInStock->in_stock = $productForInStock->product_qty - $quantities[$key];
                $productForInStock->save();
            }
            $cartItem = DB::table('carts')->where('buyer_id', $buyerId)
                ->delete();
            $orderedBuyer = Buyer::find($buyerId);
            $orderDetails = OrderDetail::with('order')->with('buyer')->with('seller')
                ->where('buyer_id', $buyerId)->where('order_id', $order->id)->get();
            $bankInfo = BankAccount::find($bankAccountId);

            DB::commit();
            \Mail::to($orderedBuyer->email)->send(new \App\Mail\BuyerCashOrderConfirmation($orderDetails, $bankInfo, $totalAmount, $transferPersonName, $transferDate, $name));

            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                \Mail::to($admin->email)->send(new \App\Mail\AdminCashOrderConfirmation($orderDetails, $bankInfo, $totalAmount, $transferPersonName, $transferDate, $name, $admin));
            }

            Notification::create([
                'related_id' => $order->id,
                'message' => 'A new order added:',
                'time' => Carbon::now(),
                'seen' => 0,
            ]);

            return response()->json([
                'message' => 'Your order has been successfully placed.', 'orderId' => $order->id
            ]);
        } catch (\Exception $e) {
            // Log any exceptions for debugging
            DB::rollBack();
            // Log the exception for debugging
            Log::error('Order placement failed: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    public function orderSuccess($id)
    {
        $order = Order::with('orderDetail')->with('orderDetail.buyer')->with('orderDetail.seller')->with('orderDetail.prefecture')
            ->with('orderDetail.product')
            ->where('id', $id)->first();
        return view('front-end.order-success', compact('order'));
    }
    //Show Footer Tracking
    public function footertracking(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $id = $request->id;
        $order = Order::find($id);
        $process = Process::where('order_id', $id)->latest()->get();
        $orderDetails = DB::table('orders')
            ->join('sellers', 'orders.seller_id', '=', 'sellers.id')
            ->join('buyers', 'orders.buyer_id', '=', 'buyers.id')
            ->where('buyers.user_id', Auth::user()->id)
            ->where('orders.id', $id)
            ->select('orders.*', 'orders.id as order_id', 'sellers.*', 'orders.post_code as code', 'orders.city as buyercity', 'orders.chome as buyerchome', 'orders.building as buyerbuilding', 'orders.room_no as buyerroom')
            ->get();

        foreach ($orderDetails as $location) {
            $locationcity = $location->buyercity;
            $locationchome = $location->buyerchome;
        }
        return view('front-end.user-order-tracking', compact('user', 'order', 'process', 'orderDetails',));
    }

    public function userProfileUpload(Request $request)
    {
        $request->validate([
            'user_profile' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Adjust validation rules as needed
        ]);

        // Get the uploaded file
        $file = $request->file('user_profile');

        // Generate a unique name for the file
        $fileName = time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();

        // Store the file in the specified directory
        $filePath = 'upload/profile/' . $fileName;
        $file->move(public_path('upload/profile'), $fileName);

        // Update the user's photo path in the database
        $user = Auth::user(); // Assuming you're using authentication
        $user->user_photo = $fileName;
        $user->save();
        $fileUrl = '{{ asset(\'' . $filePath . '\') }}';

        // Return a JSON response with the file path
        // return response()->json(['success' => true, 'file_url' => $fileUrl]);
        return response()->json(['success' => true, 'file_url' => asset($filePath)]);
    }

    public function setDefaultAddress($id)
    {
        $buyer = Buyer::where('user_id', Auth::user()->id)->first();
        $buyerAddresses = BuyerAddress::where('buyer_id', $buyer->id)->get();
        foreach ($buyerAddresses as $buyerAddress) {
            if ($buyerAddress->id == $id) {
                $buyerAddress->default = TRUE;
                $buyerAddress->save();
            } else {
                $buyerAddress->default = FALSE;
                $buyerAddress->save();
            }
        }

        // return response()->json(['success' => 'Successfully set default address']);
        return response()->json(['success' => 'Successfully set default address']);
    }

    public function showMessage()
    {
        $limit = 5;
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $buyer = Buyer::where('user_id', $user->id)->first();
        $userNotis = UserNotification::with('orderDetail')->with('orderDetail.product')->with('orderDetail.order')
            ->with('orderDetail.seller')->where('buyer_id', $buyer->id)->orderBy('id', 'DESC')->paginate($limit);

        // to be seen
        UserNotification::where('buyer_id', $buyer->id)->update(['seen' => 1]);
        $ttl = $userNotis->total();
        $ttlpage = ceil($ttl / $limit);
        return view('front-end.user_message', compact('user', 'userNotis', 'ttl', 'ttlpage'));
    }

    public function removeMessage($id)
    {
        $message = UserNotification::find($id);
        if ($message) {
            $message->delete();
        }
        return redirect()->back()->with('success', 'Message is deleted successfully!');
    }

    public function removeMessageAll($id)
    {
        $messages = UserNotification::where('buyer_id', $id);
        $messages->delete();
        return redirect()->back()->with('success', 'Messages are deleted successfully!');
    }
}