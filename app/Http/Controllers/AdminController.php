<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Process;
use App\Models\Category;
use App\Models\SubCategoryTitle;
use App\Models\Review;
use App\Models\Seller;
use App\Models\Help;
use App\Models\SellerNotification;
use App\Models\Notification;
use App\Models\MultiImg;
use App\Models\Coupon;
use App\Models\Transfer;
use App\Models\Top;
use App\Models\NewsLetter;
use App\Models\Customer;
use App\Models\Brand;
use App\Models\Country;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Mail;
use App\Providers\RouteServiceProvider;
use DateTime;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\BankAccount;
use App\Models\Blog;
use App\Models\Buyer;
use App\Models\CashBankAccount;
use App\Models\Faq;
use App\Models\Story;
use App\Models\UserNotification;
use Illuminate\Support\Facades\File;

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */

class AdminController extends Controller
{
    public function welcome()
    {
        // coupon to be inactive for the end date
        $couponAll = Coupon::where('enddate', '<=', Carbon::now()->endOfDay())->get();
        foreach ($couponAll as $couponInactive) {
            $couponInactive->status = 0;
            $couponInactive->save();

            $sellers = Seller::where('coupon_id', $couponInactive->id)->get();
            foreach ($sellers as $seller) {
                $seller->coupon_id = NULL;
                $seller->coupon_status = 0;
                $seller->save();
            }

            $products = Product::where('coupon_id', $couponInactive->id)->get();
            foreach ($products as $product) {
                $product->coupon_id = NULL;
                $product->coupon_status = 0;
                $product->save();
            }
        }
        // end coupon to be inactive for the end date

        // not payment order in time deleted
        $notPaymentOrders = Order::where('payment_approved', 0)->get();

        if (!$notPaymentOrders->isEmpty()) {
            foreach ($notPaymentOrders as $order) {
                $checkCashBankAccount = CashBankAccount::where('order_id', $order->id)->first();

                if ($checkCashBankAccount && Carbon::now()->startOfDay()->gt(Carbon::parse($checkCashBankAccount->created_at)->addDays(7)->startOfDay())) {
                    $notPaymentOrderDetails = OrderDetail::where('order_id', $order->id)->get();

                    foreach ($notPaymentOrderDetails as $orderDetail) {
                        $checkProduct = Product::where('id', $orderDetail->product_id)->first();

                        if ($checkProduct) {
                            $checkProduct->in_stock += $orderDetail->qty;
                            $checkProduct->save();
                        }

                        UserNotification::create([
                            'order_detail_id' => $orderDetail->id,
                            'buyer_id' => $orderDetail->buyer_id,
                            'title' => 'Cash Cancel',
                            'seen' => 0
                        ]);

                        Notification::create([
                            'related_id' => $orderDetail->buyer_id,
                            'message' => $orderDetail->buyer->name . ' did not pay in time for cash order:',
                            'time' => Carbon::now(),
                            'seen' => 0,
                        ]);

                        $orderDetail->update([
                            'payment_approved' => 2,
                            'status' => 'Cash Cancel',
                            'cancelled_reason' => 'You did not transfer payment for this order in time.'
                        ]);
                        $order->update([
                            'payment_approved' => 2
                        ]);
                    }
                }
            }
        }
        // end not payment order in time deleted

        $categories = Category::where('category_name', '!=', 'Special Corner')->get();

        $blogs = DB::table('blogs')
            ->select('U.name as authorby', 'blogs.*')
            ->join('users as U', function ($join) {
                $join->on('blogs.created_by', '=', 'U.id');
            })
            ->orderBy('created_at', 'desc')->paginate(2);

        $maxStarsRatedRow = DB::table('reviews')
            ->select('users.id', 'users.name', 'users.user_photo', 'reviews.comment', DB::raw('MAX(stars_rated) as max_stars_rated'))
            ->join('users', 'users.id', '=', 'reviews.user_id')
            ->groupBy('users.id', 'users.name', 'reviews.comment')
            ->orderByDesc('max_stars_rated')
            ->first();

        $customers =  Customer::all();

        $mostDiscountPercentages = [5, 10, 15, 20, 25, 30, 35, 40, 45, 50];

        $productsGroupedByDiscount = [];

        foreach ($mostDiscountPercentages as $discountPercent) {
            $productsGroupedByDiscount[$discountPercent] = Product::where('discount_percent', $discountPercent)
                ->where('status', 1)
                ->pluck('id')
                ->toArray();
        }

        $couponProducts = Product::where(function ($query) {
            $query->whereHas('Seller', function ($query) {
                $query->where('coupon_status', 1);
            })
                ->orWhere('products.coupon_status', '=', '1');
        })->where('status', 1)->get();

        $reviews = Review::all();

        $startMonth = Carbon::now()->startOfMonth()->subMonth()->startOfMonth();
        $endMonth = Carbon::now()->endOfMonth();

        $bestSellerProducts = DB::table('products')
            ->select('products.*', DB::raw('COUNT(order_details.id) as total_orders'))
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->whereBetween('order_details.created_at', [$startMonth, $endMonth])
            ->where('products.status', 1)
            ->groupBy('products.id')
            ->orderByDesc('total_orders')
            ->get();

        $endDate = Carbon::now()->endOfDay();
        $startDate = Carbon::now()->subDays(7)->startOfDay();
        $trendingProducts = DB::table('products')
            ->select('products.*', DB::raw('COUNT(order_details.id) as total_orders'))
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->whereBetween('order_details.created_at', [$startDate, $endDate])
            ->where('products.status', 1)
            ->groupBy('products.id')
            ->orderByDesc('total_orders')
            ->take(4)
            ->get();

        $coupons = Coupon::with('seller')->with('product')->where('status', 1)->orderBy('enddate', 'asc')->get();

        $seafood = Product::leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->where('categories.category_name', 'Seafood')
            ->where('products.status', 1)->pluck('products.id')
            ->toArray();

        $vegetable = Product::leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->where('categories.category_name', 'Vegetable')
            ->where('products.status', 1)->pluck('products.id')
            ->toArray();

        $meatHalfDiscount = Product::leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->where('discount_percent', 50)
            ->where('categories.category_name', 'Meat')
            ->where('products.status', 1)
            ->pluck('products.id')->toArray();

        $vegetableHalfDiscount = Product::leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->where('discount_percent', 50)
            ->where('categories.category_name', 'Vegetable')
            ->where('products.status', 1)
            ->pluck('products.id')->toArray();

        $latestProducts = Product::orderBy('created_at', 'DESC')->where('status', 1)->take(5)->get();

        $shops = Seller::where('status', 1)->get();

        $tops = Top::all();

        return view('front-end.welcome', compact(
            'blogs',
            'categories',
            'maxStarsRatedRow',
            'productsGroupedByDiscount',
            'couponProducts',
            'reviews',
            'bestSellerProducts',
            'trendingProducts',
            'coupons',
            'seafood',
            'vegetable',
            'meatHalfDiscount',
            'vegetableHalfDiscount',
            'customers',
            'latestProducts',
            'shops',
            'tops'
        ));
    }

    public function news()
    {
        $validated = request()->validate([
            'search' => 'string|nullable',
        ]);

        $search = $validated['search'] ?? null;
        $limit = 10;

        if ($search) {
            $blogs = DB::table('blogs')
                ->select('U.name as authorby', 'blogs.*')
                ->join('users as U', function ($join) {
                    $join->on('blogs.created_by', '=', 'U.id');
                })
                ->where('blogs.title', 'like', '%' . $search . '%')
                ->orderBy('created_at', 'desc')->paginate($limit);
        } else {
            $blogs = DB::table('blogs')
                ->select('U.name as authorby', 'blogs.*')
                ->join('users as U', function ($join) {
                    $join->on('blogs.created_by', '=', 'U.id');
                })
                ->orderBy('created_at', 'desc')->paginate($limit);
        }

        $limit = 4;
        $latestblog = DB::table('blogs')
            ->orderBy('created_at', 'desc')
            ->paginate($limit);

        $ttl = $blogs->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('front-end.blog-list', compact('blogs', 'ttlpage', 'ttl', 'latestblog', 'search'));
    }

    public function validatesubadmin($request, $editpassword = true, $editmode = false, $emailuniquecheck = true, $needimg = true)
    {

        $check = [
            'name' => 'required|string|max:255',
            // 'agerange' => 'required|not_in:0',
            'phone' => ['required', 'regex:/^(0([1-9]{1}-?[1-9]\d{3}|[1-9]{2}-?\d{3}|[1-9]{2}\d{1}-?\d{2}|[1-9]{2}\d{2}-?\d{1})-?\d{4}|0[789]0-?\d{4}-?\d{4}|050-?\d{4}-?\d{4})$/'],
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:255',

        ];

        $messages = [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required.',
            'address.required' => 'The address field is required.',
            'image.mimes' => '画像ファイルをアップロードしてください。',
            'image.required' => '画像ファイルをアップロードしてください。',
            // Add more custom error messages as needed
        ];


        if (!$editpassword) {
            unset($check['password']);
        }

        if ($editmode) {
            unset($check['check']);
        }

        if ($emailuniquecheck) {
            $check['email'] .= '|unique:users';
        }

        if (!$needimg) {
            unset($check['image']);
        }

        $validator = Validator::make($request->all(), $check, $messages);


        return $validator;
    }
    public function updateuser(Request $request)
    {
        if (!empty($request->id)) {

            $userprofile = User::find($request->id);
        } else {
            $userprofile = Auth::user();
        }

        if ($userprofile->role == 'admin') {

            $checkpassword = true;
            if (empty($request->password) and empty($request->password_confirmation)) {
                $checkpassword = false;
            }

            if ($userprofile->email == $request->email) {
                $emailuniquecheck = false;
            } else {
                $emailuniquecheck = true;
            }


            $validator = $this->validatesubadmin($request, $checkpassword, true, $emailuniquecheck);
            //return response()->json(['error'=>'123']);
        }

        if ($request->ajax()) {

            if ($validator->passes()) {
                return response()->json(['success' => 'allpasses']);
            }
            return response()->json(['error' => $validator->errors()]);
        }

        $newval = array(
            'name' => $request->name,
            'email' => $request->email,
        );


        if (!empty($request->shopname)) {
            $newval['shop_name'] = $request->shopname;
        }

        if (!empty($request->shopyear)) {
            $newval['shop_establish'] = $request->shopyear;
        }

        if (!empty($request->phone)) {
            $newval['phone'] = $request->phone;
        }

        if (!empty($request->zipcode)) {
            $newval['zip_code'] = $request->zipcode;
        }

        if (!empty($request->shoplink)) {
            $newval['url'] = $request->shoplink;
        }

        if (!empty($request->address)) {
            $newval['address'] = $request->address;
        }


        // Bank

        if (!empty($request->bankname)) {
            $newval['bank_name'] = $request->bankname;
        }

        if (!empty($request->accounttype)) {
            $newval['bank_acc_type'] = $request->accounttype;
        }

        if (!empty($request->branchname)) {
            $newval['bank_branch'] = $request->branchname;
        }

        if (!empty($request->bankaccountname)) {
            $newval['bank_acc_name'] = $request->bankaccountname;
        }

        if (!empty($request->bankaccountnumber)) {
            $newval['bank_acc_no'] = $request->bankaccountnumber;
        }
        //END Bank

        if (!empty($request->password)) {
            $newval['password'] = Hash::make($request->password);
        }

        if (!empty($request->shoplogo)) {
            $time = new DateTime();
            $imageNames = time() . '.' . $request->shoplogo->extension();

            $request->shoplogo->move(public_path('images'), $imageNames);
            $newval['shop_logo'] = $imageNames;
        }
        if (!empty($request->image)) {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);
            $newval['user_photo'] = $imageName;
        }

        if ($userprofile->role == 'admin' or $userprofile->role == 'seller' or $userprofile->role == 'buyer') {
            $upd = $userprofile->update($newval);
        }
        if ($userprofile->role == 'seller') {

            $sellerupd = $sellerprofile->update($newval);
        }

        $msg = __('Profile Updated Successfully');

        return back()->with('success', $msg);
    }



    public function updatehost(Request $request)
    {
        if (!empty($request->id)) {

            $userprofile = User::find($request->id);

            $userid = DB::table('users')
                ->select('users.id', 'users.email')
                ->where('id', $request->id)->get()->pluck('email');

            $sellerid = DB::table('sellers')
                ->select('sellers.id')
                ->where('email', $userid[0])->pluck('id');

            $sellerprofile = Seller::find($sellerid[0]);
        } else {
            $userprofile = Auth::user();
        }

        if ($userprofile->role == 'admin') {

            $checkpassword = true;
            if (empty($request->password) and empty($request->password_confirmation)) {
                $checkpassword = false;
            }

            if ($userprofile->email == $request->email) {
                $emailuniquecheck = false;
            } else {
                $emailuniquecheck = true;
            }


            $validator = $this->validatesubadmin($request, $checkpassword, true, $emailuniquecheck);
        }

        if ($userprofile->role == 'buyer' or $userprofile->role == 'seller') {

            $checkpassword = true;
            if (empty($request->password) and empty($request->password_confirmation)) {
                $checkpassword = false;
            }

            if ($userprofile->email == $request->email) {
                $emailuniquecheck = false;
            } else {
                $emailuniquecheck = true;
            }

            $validator = (new RegisteredUserController)->validateuser($request, $checkpassword, true, $emailuniquecheck);
        }

        if ($request->ajax()) {

            if ($validator->passes()) {
                return response()->json(['success' => 'allpasses']);
            }
            return response()->json(['error' => $validator->errors()]);
        }

        $newval = array(
            'name' => $request->name,
            'email' => $request->email,
        );


        if (!empty($request->shopname)) {
            $newval['shop_name'] = $request->shopname;
        }

        if (!empty($request->shopyear)) {
            $newval['shop_establish'] = $request->shopyear;
        }

        if (!empty($request->phone)) {
            $newval['phone'] = $request->phone;
        }

        if (!empty($request->zipcode)) {
            $newval['zip_code'] = $request->zipcode;
        }

        if (!empty($request->shoplink)) {
            $newval['url'] = $request->shoplink;
        }

        if (!empty($request->address)) {
            $newval['address'] = $request->address;
        }

        // Bank

        if (!empty($request->bankname)) {
            $newval['bank_name'] = $request->bankname;
        }

        if (!empty($request->accounttype)) {
            $newval['bank_acc_type'] = $request->accounttype;
        }

        if (!empty($request->branchname)) {
            $newval['bank_branch'] = $request->branchname;
        }

        if (!empty($request->bankaccountname)) {
            $newval['bank_acc_name'] = $request->bankaccountname;
        }

        if (!empty($request->bankaccountnumber)) {
            $newval['bank_acc_no'] = $request->bankaccountnumber;
        }
        //END Bank

        if (!empty($request->password)) {
            $newval['password'] = Hash::make($request->password);
        }

        if (!empty($request->shoplogo)) {
            $time = new DateTime();
            $imageNames = time() . '.' . $request->shoplogo->extension();

            $request->shoplogo->move(public_path('images'), $imageNames);
            $newval['shop_logo'] = $imageNames;
        }
        if (!empty($request->image)) {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);
            $newval['user_photo'] = $imageName;
        }

        if ($userprofile->role == 'admin' or $userprofile->role == 'seller' or $userprofile->role == 'buyer') {
            $upd = $userprofile->update($newval);
        }
        if ($userprofile->role == 'seller') {

            $sellerupd = $sellerprofile->update($newval);
        }

        $msg = __('auth.donechange');

        return back()->with('success', $msg);
    }

    public function indexcategory()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Category::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('category_name', 'like', '%' . $mainSearch . '%');
            })
                ->orWhereHas('subCategoryTitle', function ($query) use ($mainSearch) {
                    $query->where('sub_category_titlename', 'like', '%' . $mainSearch . '%');
                })
                ->orWhereHas('subCategoryTitle.subCategory', function ($query) use ($mainSearch) {
                    $query->where('sub_category_name', 'like', '%' . $mainSearch . '%');
                });
        }

        $lists = $query->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.category', compact('lists', 'ttlpage', 'ttl'));
    }

    public function indexblog()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Blog::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('title', 'like', '%' . $mainSearch . '%');
            });
        }

        $lists = $query->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.blog.blog', compact('lists', 'ttlpage', 'ttl', 'mainSearch'));
    }


    public function indextop()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Top::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('discount', 'like', '%' . $mainSearch . '%')
                    ->orWhere('phaseone', 'like', '%' . $mainSearch . '%')
                    ->orWhere('phasetwo', 'like', '%' . $mainSearch . '%')
                    ->orWhere('phasethree', 'like', '%' . $mainSearch . '%');
            });
        }

        $lists = $query->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.top', compact('lists', 'ttlpage', 'ttl'));
    }

    public function indexnewsletter()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = NewsLetter::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('email', 'like', '%' . $mainSearch . '%');
            });
        }

        $lists = $query->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.newsletter', compact('lists', 'ttlpage', 'ttl'));
    }

    public function indexcustomer()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Customer::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('title', 'like', '%' . $mainSearch . '%')
                    ->orWhere('subtitle', 'like', '%' . $mainSearch . '%')
                    ->orWhere('content', 'like', '%' . $mainSearch . '%')
                    ->orWhere('name', 'like', '%' . $mainSearch . '%')
                    ->orWhere('position', 'like', '%' . $mainSearch . '%');
            });
        }

        $lists = $query->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.indexcustomer', compact('lists', 'ttlpage', 'ttl'));
    }



    public function indexreview()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Review::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('comment', 'like', '%' . $mainSearch . '%');
            })
                ->orWhereHas('user', function ($query) use ($mainSearch) {
                    $query->where('name', 'like', '%' . $mainSearch . '%');
                })
                ->orWhereHas('product', function ($query) use ($mainSearch) {
                    $query->where('product_name', 'like', '%' . $mainSearch . '%');
                });
        }

        $lists = $query->leftjoin('users', 'users.id', '=', 'reviews.user_id')
            ->leftjoin('products', 'products.id', '=', 'reviews.product_id')
            ->select('reviews.*', 'reviews.created_at as reviewdate', 'products.*', 'users.*', 'reviews.id', 'reviews.status')
            ->orderBy('reviews.created_at', 'desc')
            ->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.product.product_review', compact('lists', 'ttlpage', 'ttl'));
    }

    public function indexproduct()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Product::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('product_name', 'like', '%' . $mainSearch . '%')
                    ->orWhere('product_qty', 'like', '%' . $mainSearch . '%')
                    ->orWhere('selling_price', 'like', '%' . $mainSearch . '%')
                    ->orWhere('discount_percent', 'like', '%' . $mainSearch . '%')
                    ->orWhere('commission', 'like', '%' . $mainSearch . '%');
            });
        }
        $query->leftjoin('coupons', 'products.coupon_id', '=', 'coupons.id')
            ->select('products.*', 'coupons.enddate', 'coupon_code as coupon_code')
            ->orderBy('products.created_at', 'desc');

        $lists = $query->with('Seller')->orderBy('products.created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        $subCatTitle = SubCategoryTitle::whereHas('category', function ($query) {
            $query->where('category_name', 'Special Corner');
        })->get();

        $coupons = DB::table('coupons')->where('status', 1)->orderBY('created_at', 'desc')->get();

        return view('admin.product.product_all', compact('lists', 'ttlpage', 'ttl', 'subCatTitle', 'coupons', 'mainSearch'));
    }

    public function shoplist()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Seller::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('shop_name', 'like', '%' . $mainSearch . '%')
                    ->orWhereHas('coupons', function ($query) use ($mainSearch) {
                        $query->where('coupon_code', 'like', '%' . $mainSearch . '%');
                    });
            });
        }

        //Identify expired coupons
        $expiredCoupons = DB::table('coupons')
            ->where('enddate', '<', now())
            ->pluck('id');
        // Update status of corresponding sellers
        $inactivestatus = DB::table('sellers')
            ->whereIn('coupon_id', $expiredCoupons)
            ->update(['coupon_id' => null]);

        $lists = $query->with('user')
            ->with('user.products')
            ->with('user.products.reviews')
            ->latest('sellers.created_at')
            ->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));
        $coupons = DB::table('coupons')->where('status', 1)->orderBY('created_at', 'desc')->get();

        return view('admin.allshop', compact('lists', 'ttlpage', 'ttl', 'coupons'));
    }


    public function indexshopproduct($id)
    {
        $limit = 12;

        $validated = request()->validate([
            'page' => 'integer|min:1',
            'sort' => 'integer|min:1',
            'search' => 'string|nullable',
            'categories' => 'array',
            'categories.*' => 'integer|distinct|min:1',
            'price' => 'string|nullable',
            'rating' => 'array',
            'rating.*' => 'integer|distinct|min:1',
            'discount' => 'array',
            'discount.*' => 'integer|distinct|min:1',
        ]);

        $page = $validated['page'] ?? 1;
        $sort = $validated['sort'] ?? 0;
        $search = $validated['search'] ?? null;
        $categories = $validated['categories'] ?? [];
        $price = $validated['price'] ?? null;
        $rating = $validated['rating'] ?? [];
        $discount = $validated['discount'] ?? [];

        $query = Product::query();

        if (!empty($search)) {
            $query->where('product_name', 'like', '%' . $search . '%');
        }

        if (!empty($categories)) {
            $query->whereIn('category_id', $categories);
        }

        if (!empty($price)) {
            $priceRange = explode(';', $price);

            if (count($priceRange) == 2) {
                $minPrice = (float)$priceRange[0];
                $maxPrice = (float)$priceRange[1];

                $query->whereRaw('CAST(selling_price AS DECIMAL) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
            }
        }

        if (!empty($rating)) {
            $averageRated = Review::select(
                'product_id',
                DB::raw('FLOOR(AVG(stars_rated)) AS `average_rating`')
            )
                ->join('products', 'products.id', '=', 'reviews.product_id')
                ->where('products.seller_id', $id)
                ->groupBy('product_id')
                ->get();
            $matchedProductIds = [];
            foreach ($averageRated as $rated) {
                if (in_array($rated->average_rating, $rating)) {
                    $matchedProductIds[] = $rated->product_id;
                }
            }
            if (!empty($matchedProductIds)) {
                $query->whereIn('products.id', $matchedProductIds);
            } else {
                $query->where('id', null);
            }
        }

        if (!empty($discount)) {
            if (in_array("1", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) <= 5');
            }
            if (in_array("2", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10');
            }
            if (in_array("3", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15');
            }
            if (in_array("4", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25');
            }
            if (in_array("5", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 25');
            }
        }

        switch ($sort) {
            case 1:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) ASC');
                break;
            case 2:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) DESC');
                break;
            case 3:
                $query->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
                    ->select('products.*', DB::raw('COUNT(reviews.product_id) as review_count'))
                    ->groupBy('products.id')
                    ->orderBy('review_count', 'DESC');
                break;
            case 4:
                $query->orderBy('product_name', 'ASC');
                break;
            case 5:
                $query->orderBy('product_name', 'DESC');
                break;
            case 6:
                $query->orderByRaw('CAST(discount_percent AS DECIMAL(10,2)) DESC');
                break;
            default:
                // No sorting applied
                break;
        }

        $shoplist = $query->where('products.seller_id', $id)
            ->where('products.status', 1)
            ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $shoplist->total();
        $ttlpage = (ceil($ttl / $limit));

        $reviews = Review::all();

        $categoryWithProductCount = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->select('categories.*', DB::raw('COUNT(products.category_id) as product_count'))
            ->where('products.status', '=', '1')
            ->where('products.seller_id', $id)
            ->groupBy('categories.id')
            ->get();

        $ratingWithProductCount = Review::select(
            DB::raw('CAST(FLOOR(AVG(stars_rated)) AS UNSIGNED) AS `average_rating`')
        )
            ->join('products', 'products.id', '=', 'reviews.product_id')
            ->where('products.seller_id', $id)
            ->groupBy('product_id')
            ->get()
            ->groupBy('average_rating')
            ->map(function ($grouped) {
                return $grouped->count();
            });

        $discountWithProductCount = Product::selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) <= 5 THEN 1 END) as group_1_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10 THEN 1 END) as group_2_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15 THEN 1 END) as group_3_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25 THEN 1 END) as group_4_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 25 THEN 1 END) as group_5_count')
            ->where('seller_id', $id)
            ->where('status', '=', '1')
            ->first();

        $shopInfo = Seller::with('user')->with('user.products')->with('user.products.reviews')->where('user_id', $id)->first();
        $ratingWith = 0;
        $reviewCount = 0;
        $productStarReview = 0;
        $productCount = 0;
        $ratingForShop = [];
        foreach ($shopInfo->user->products as $product) {
            if ($product->reviews->isNotEmpty()) {
                foreach ($product->reviews as $review) {
                    $ratingWith += $review->stars_rated;
                    $reviewCount++;
                }
                $productStarReview += $ratingWith / $product->reviews->count();
                $ratingWith = 0;
            }
            $productCount++;
        }
        if ($productStarReview > 0) {
            $ratingForShop[0] = floor($productStarReview / $productCount);
            $ratingForShop[1] = $reviewCount;
        } else {
            $ratingForShop[0] = 0;
            $ratingForShop[1] = 0;
        }

        return view('front-end.shop-left-sidebar', compact(
            'id',
            'shoplist',
            'ttlpage',
            'ttl',
            'price',
            'search',
            'rating',
            'ratingWithProductCount',
            'discount',
            'discount',
            'discountWithProductCount',
            'sort',
            'reviews',
            'shopInfo',
            'categoryWithProductCount',
            'categories',
            'ratingForShop'
        ));
    }

    public function indexsubcategory()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Category::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('category_name', 'like', '%' . $mainSearch . '%')
                    ->orWhere('sub_category_titlename', 'like', '%' . $mainSearch . '%')
                    ->orWhere('sub_category_name', 'like', '%' . $mainSearch . '%');
            });
        }
        $lists = $query->select('categories.id as categoryId', 'categories.category_name as category', 'categories.category_name_jp as categoryJp', 'Sb.id as subCatId', 'Sb.sub_category_name', 'S.id as subCatTitleId', 'S.sub_category_titlename')
            ->leftJoin('sub_category_titles as S', function ($join) {
                $join->on('categories.id', '=', 'S.category_id');
            })
            ->leftJoin('sub_categories as Sb', function ($join) {
                $join->on('Sb.sub_category_title_id', '=', 'S.id');
                $join->on('Sb.category_id', '=', 'categories.id');
            })
            ->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.allsubcategory', compact('lists', 'ttlpage', 'ttl'));
    }

    public function blogdetail($id)
    {
        $blog = DB::table('blogs')
            ->select('blogs.*')
            ->where('blogs.id', $id)->get();
        $blog = $blog[0];

        return view('admin.blog.blog_detail', compact('blog'));
    }

    public function faqdetail($id)
    {
        $faq = DB::table('faqs')
            ->select('faqs.*')
            ->where('faqs.id', $id)->get();
        $faq = $faq[0];

        return view('admin.faqdetail', compact('faq'));
    }
    public function indexshop($id)
    {
        $limit = 12;
        $validated = request()->validate([
            'page' => 'integer|min:1',
            'sort' => 'integer|min:1',
            'search' => 'string|nullable',
            'categories' => 'array',
            'categories.*' => 'integer|distinct|min:1',
            'price' => 'string|nullable',
            'rating' => 'array',
            'rating.*' => 'integer|distinct|min:1',
            'discount' => 'array',
            'discount.*' => 'integer|distinct|min:1',
        ]);

        $page = $validated['page'] ?? 1;
        $sort = $validated['sort'] ?? 0;
        $search = $validated['search'] ?? null;
        $price = $validated['price'] ?? null;
        $rating = $validated['rating'] ?? [];
        $discount = $validated['discount'] ?? [];

        $query = Product::query();

        if (!empty($search)) {
            $query->where('product_name', 'like', '%' . $search . '%');
        }

        if (!empty($price)) {
            $priceRange = explode(';', $price);

            if (count($priceRange) == 2) {
                $minPrice = (float)$priceRange[0];
                $maxPrice = (float)$priceRange[1];

                $query->whereRaw('CAST(selling_price AS DECIMAL) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
            }
        }

        if (!empty($rating)) {
            $averageRated = Review::select(
                'product_id',
                DB::raw('FLOOR(AVG(stars_rated)) AS `average_rating`')
            )
                ->join('products', 'products.id', '=', 'reviews.product_id')
                ->where('products.category_id', $id)
                ->groupBy('product_id')
                ->get();
            $matchedProductIds = [];
            foreach ($averageRated as $rated) {
                if (in_array($rated->average_rating, $rating)) {
                    $matchedProductIds[] = $rated->product_id;
                }
            }
            if (!empty($matchedProductIds)) {
                $query->whereIn('products.id', $matchedProductIds);
            } else {
                $query->where('id', null);
            }
        }

        if (!empty($discount)) {
            if (in_array("1", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) <= 5');
            }
            if (in_array("2", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10');
            }
            if (in_array("3", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15');
            }
            if (in_array("4", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25');
            }
            if (in_array("5", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 25');
            }
        }

        switch ($sort) {
            case 1:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) ASC');
                break;
            case 2:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) DESC');
                break;
            case 3:
                $query->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
                    ->select('products.*', DB::raw('COUNT(reviews.product_id) as review_count'))
                    ->groupBy('products.id')
                    ->orderBy('review_count', 'desc');
                break;
            case 4:
                $query->orderBy('product_name', 'ASC');
                break;
            case 5:
                $query->orderBy('product_name', 'DESC');
                break;
            case 6:
                $query->orderByRaw('CAST(discount_percent AS DECIMAL(10,2)) DESC');
                break;
            default:
                // No sorting applied
                break;
        }

        $shoplist = $query->where('category_id', $id)->where('products.status', 1)
            ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $shoplist->total();
        $ttlpage = (ceil($ttl / $limit));

        $reviews = Review::all();

        $ratingWithProductCount = Review::select(
            DB::raw('CAST(FLOOR(AVG(stars_rated)) AS UNSIGNED) AS `average_rating`')
        )
            ->join('products', 'products.id', '=', 'reviews.product_id')
            ->where('products.category_id', $id)
            ->groupBy('product_id')
            ->get()
            ->groupBy('average_rating')
            ->map(function ($grouped) {
                return $grouped->count();
            });

        $discountWithProductCount = Product::selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) <= 5 THEN 1 END) as group_1_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10 THEN 1 END) as group_2_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15 THEN 1 END) as group_3_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25 THEN 1 END) as group_4_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 25 THEN 1 END) as group_5_count')
            ->where('category_id', $id)
            ->where('status', '=', '1')
            ->first();

        return view('front-end.shop-left-sidebar', compact(
            'id',
            'shoplist',
            'ttlpage',
            'ttl',
            'price',
            'search',
            'rating',
            'ratingWithProductCount',
            'discount',
            'discount',
            'discountWithProductCount',
            'sort',
            'reviews'
        ));
    }

    public function indexcategoryproduct($id)
    {
        $limit = 12;
        $validated = request()->validate([
            'page' => 'integer|min:1',
            'sort' => 'integer|min:1',
            'search' => 'string|nullable',
            'categories' => 'array',
            'categories.*' => 'integer|distinct|min:1',
            'price' => 'string|nullable',
            'rating' => 'array',
            'rating.*' => 'integer|distinct|min:1',
            'discount' => 'array',
            'discount.*' => 'integer|distinct|min:1',
        ]);

        $page = $validated['page'] ?? 1;
        $sort = $validated['sort'] ?? 0;
        $search = $validated['search'] ?? null;
        $categories = $validated['categories'] ?? [];
        $price = $validated['price'] ?? null;
        $rating = $validated['rating'] ?? [];
        $discount = $validated['discount'] ?? [];

        $query = Product::query();

        if (!empty($search)) {
            $query->where('product_name', 'like', '%' . $search . '%');
        }

        if (!empty($categories)) {
            $query->whereIn('category_id', $categories);
        }

        if (!empty($price)) {
            $priceRange = explode(';', $price);

            if (count($priceRange) == 2) {
                $minPrice = (float)$priceRange[0];
                $maxPrice = (float)$priceRange[1];

                $query->whereRaw('CAST(selling_price AS DECIMAL) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
            }
        }

        if (!empty($rating)) {
            $averageRated = Review::select(
                'product_id',
                DB::raw('FLOOR(AVG(stars_rated)) AS `average_rating`')
            )
                ->join('products', 'products.id', '=', 'reviews.product_id')
                ->where('products.category_id', $id)
                ->groupBy('product_id')
                ->get();
            $matchedProductIds = [];
            foreach ($averageRated as $rated) {
                if (in_array($rated->average_rating, $rating)) {
                    $matchedProductIds[] = $rated->product_id;
                }
            }
            if (!empty($matchedProductIds)) {
                $query->whereIn('products.id', $matchedProductIds);
            } else {
                $query->where('id', null);
            }
        }

        if (!empty($discount)) {
            if (in_array("1", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) <= 5');
            }
            if (in_array("2", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10');
            }
            if (in_array("3", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15');
            }
            if (in_array("4", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25');
            }
            if (in_array("5", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 25');
            }
        }

        switch ($sort) {
            case 1:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) ASC');
                break;
            case 2:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) DESC');
                break;
            case 3:
                $query->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
                    ->select('products.*', DB::raw('COUNT(reviews.product_id) as review_count'))
                    ->groupBy('products.id')
                    ->orderBy('review_count', 'desc');
                break;
            case 4:
                $query->orderBy('product_name', 'ASC');
                break;
            case 5:
                $query->orderBy('product_name', 'DESC');
                break;
            case 6:
                $query->orderByRaw('CAST(discount_percent AS DECIMAL(10,2)) DESC');
                break;
            default:
                // No sorting applied
                break;
        }

        $shoplist = $query->where('category_id', $id)->where('products.status', 1)
            ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $shoplist->total();
        $ttlpage = (ceil($ttl / $limit));

        $reviews = Review::all();

        $categoryWithProductCount = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->select('categories.*', DB::raw('COUNT(products.category_id) as product_count'))
            ->where('products.status', '=', '1')
            ->where('products.category_id', $id)
            ->groupBy('categories.id')
            ->get();

        $ratingWithProductCount = Review::select(
            DB::raw('CAST(FLOOR(AVG(stars_rated)) AS UNSIGNED) AS `average_rating`')
        )
            ->join('products', 'products.id', '=', 'reviews.product_id')
            ->where('products.category_id', $id)
            ->where('products.status', '=', '1')
            ->groupBy('product_id')
            ->get()
            ->groupBy('average_rating')
            ->map(function ($grouped) {
                return $grouped->count();
            });

        $discountWithProductCount = Product::selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) <= 5 THEN 1 END) as group_1_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10 THEN 1 END) as group_2_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15 THEN 1 END) as group_3_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25 THEN 1 END) as group_4_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 25 THEN 1 END) as group_5_count')
            ->where('category_id', $id)
            ->where('status', '=', '1')
            ->first();

        return view('front-end.category-left-sidebar', compact(
            'id',
            'shoplist',
            'ttlpage',
            'ttl',
            'price',
            'search',
            'rating',
            'ratingWithProductCount',
            'discount',
            'discount',
            'discountWithProductCount',
            'sort',
            'reviews',
            'categories',
            'categoryWithProductCount'
        ));
    }

    public function indexsubcategoryproduct($id)
    {
        $limit = 12;
        $validated = request()->validate([
            'page' => 'integer|min:1',
            'sort' => 'integer|min:1',
            'search' => 'string|nullable',
            'categories' => 'array',
            'categories.*' => 'integer|distinct|min:1',
            'price' => 'string|nullable',
            'rating' => 'array',
            'rating.*' => 'integer|distinct|min:1',
            'discount' => 'array',
            'discount.*' => 'integer|distinct|min:1',
        ]);

        $page = $validated['page'] ?? 1;
        $sort = $validated['sort'] ?? 0;
        $search = $validated['search'] ?? null;
        $categories = $validated['categories'] ?? [];
        $price = $validated['price'] ?? null;
        $rating = $validated['rating'] ?? [];
        $discount = $validated['discount'] ?? [];

        $query = Product::query();

        if (!empty($search)) {
            $query->where('product_name', 'like', '%' . $search . '%');
        }

        if (!empty($categories)) {
            $query->whereIn('category_id', $categories);
        }

        if (!empty($price)) {
            $priceRange = explode(';', $price);

            if (count($priceRange) == 2) {
                $minPrice = (float)$priceRange[0];
                $maxPrice = (float)$priceRange[1];

                $query->whereRaw('CAST(selling_price AS DECIMAL) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
            }
        }

        if (!empty($rating)) {
            $averageRated = Review::select(
                'product_id',
                DB::raw('FLOOR(AVG(stars_rated)) AS `average_rating`')
            )
                ->join('products', 'products.id', '=', 'reviews.product_id')
                ->where('products.sub_category_id', $id)
                ->groupBy('product_id')
                ->get();
            $matchedProductIds = [];
            foreach ($averageRated as $rated) {
                if (in_array($rated->average_rating, $rating)) {
                    $matchedProductIds[] = $rated->product_id;
                }
            }
            if (!empty($matchedProductIds)) {
                $query->whereIn('products.id', $matchedProductIds);
            } else {
                $query->where('id', null);
            }
        }

        if (!empty($discount)) {
            if (in_array("1", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) <= 5');
            }
            if (in_array("2", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10');
            }
            if (in_array("3", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15');
            }
            if (in_array("4", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25');
            }
            if (in_array("5", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 25');
            }
        }

        switch ($sort) {
            case 1:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) ASC');
                break;
            case 2:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) DESC');
                break;
            case 3:
                $query->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
                    ->select('products.*', DB::raw('COUNT(reviews.product_id) as review_count'))
                    ->groupBy('products.id')
                    ->orderBy('review_count', 'desc');
                break;
            case 4:
                $query->orderBy('product_name', 'ASC');
                break;
            case 5:
                $query->orderBy('product_name', 'DESC');
                break;
            case 6:
                $query->orderByRaw('CAST(discount_percent AS DECIMAL(10,2)) DESC');
                break;
            default:
                // No sorting applied
                break;
        }

        $shoplist = $query->where('sub_category_id', $id)
            ->where('products.status', '=', '1')
            ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $shoplist->total();
        $ttlpage = (ceil($ttl / $limit));

        $reviews = Review::all();

        $categoryWithProductCount = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->select('categories.*', DB::raw('COUNT(products.category_id) as product_count'))
            ->where('products.status', '=', '1')
            ->where('products.sub_category_id', $id)
            ->groupBy('categories.id')
            ->get();

        $ratingWithProductCount = Review::select(
            DB::raw('CAST(FLOOR(AVG(stars_rated)) AS UNSIGNED) AS `average_rating`')
        )
            ->join('products', 'products.id', '=', 'reviews.product_id')
            ->where('products.sub_category_id', $id)
            ->where('products.status', '=', '1')
            ->groupBy('product_id')
            ->get()
            ->groupBy('average_rating')
            ->map(function ($grouped) {
                return $grouped->count();
            });

        $discountWithProductCount = Product::selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) <= 5 THEN 1 END) as group_1_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10 THEN 1 END) as group_2_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15 THEN 1 END) as group_3_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25 THEN 1 END) as group_4_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 25 THEN 1 END) as group_5_count')
            ->where('sub_category_id', $id)
            ->where('status', '=', '1')
            ->first();

        return view('front-end.sub-category-left-sidebar', compact(
            'id',
            'shoplist',
            'ttlpage',
            'ttl',
            'price',
            'search',
            'rating',
            'ratingWithProductCount',
            'discount',
            'discount',
            'discountWithProductCount',
            'sort',
            'reviews',
            'categories',
            'categoryWithProductCount'
        ));
    }

    public function bloglistdetail($id)
    {
        $validated = request()->validate([
            'search' => 'string|nullable',
        ]);

        $search = $validated['search'] ?? null;
        $limit = 10;

        if ($search) {
            $blogs = DB::table('blogs')
                ->select('U.name as authorby', 'blogs.*')
                ->join('users as U', function ($join) {
                    $join->on('blogs.created_by', '=', 'U.id');
                })
                ->where('blogs.title', 'like', '%' . $search . '%')
                ->orderBy('created_at', 'desc')->paginate($limit);
        } else {
            $blogs = DB::table('blogs')
                ->select('U.name as authorby', 'blogs.*')
                ->join('users as U', function ($join) {
                    $join->on('blogs.created_by', '=', 'U.id');
                })
                ->where('blogs.id', $id)
                ->orderBy('created_at', 'desc')->get();
            $blog = $blogs[0];
        }

        $limit = 4;
        $latestblog = DB::table('blogs')
            ->where('id', '<>', $id)
            ->orderBy('created_at', 'desc')
            ->paginate($limit);

        return view('front-end.blog-detail', compact('blog', 'latestblog', 'search'));
    }

    public function productdetail($id)
    {
        $product = Product::find($id);
        $multiImgs = MultiImg::where('product_id', $id)->get();
        return view('admin.product.product_detail', compact('product', 'multiImgs'));
    }

    public function shopdetail($id)
    {
        $shops = Seller::where('sellers.id', $id)->get();
        $coupon_id = DB::table('sellers')
            ->where('id', $id)
            ->pluck('coupon_id')
            ->first();
        $coupon_code = DB::table('coupons')
            ->where('id', $coupon_id)
            ->pluck('coupon_code')
            ->first();
        $shop = $shops[0];

        return view('admin.shopdetail', compact('shop', 'coupon_code'));
    }

    public function coupondetail($id)
    {
        $coupon = DB::table('coupons')
            ->select('coupons.*')
            ->where('id', $id)
            ->first();

        return view('admin.coupondetail', compact('coupon'));
    }


    public function editdata(Request $request, $role, $id)
    {
        if (empty($role)) {
            $role = Auth::user()->role;
        }
        //
        $edituser = Auth::user();

        if (strlen($id) > 5) {
            $id = substr($id, 5);

            if ($role == 'admin') {
                $edituser = User::find($id);
            }
            if ($role == 'buyer') {
                $edituser = DB::table('users')
                    ->select('buyers.*', 'users.*', 'users.id')
                    ->join('buyers', function ($join) {
                        $join->on('users.id', '=', 'buyers.user_id');
                    })
                    ->where('users.id', $id)
                    ->orderBy('users.created_at', 'desc')->first();
            }
            if ($role == 'seller') {
                $editseller = DB::table('users')
                    ->select('sellers.*', 'users.*', 'users.id')
                    ->join('sellers', function ($join) {
                        $join->on('users.id', '=', 'sellers.user_id');
                    })
                    ->where('users.id', $id)
                    ->orderBy('users.created_at', 'desc')->first();
            }

            $editother = true;
        } else {
            $editother = false;
        }
        $editmode = true;

        if ($role == 'admin') {

            return view('admin.edituser', compact('editmode', 'editother', 'edituser'));
        } else if ($role == 'buyer') {
            return view('admin.editbuyerprofile', compact('editmode', 'editother', 'edituser'));
        } else if ($role == 'seller') {
            return view('admin.editsellerprofile', compact('editmode', 'editother', 'editseller'));
        } else {
            return view('admin.edituser', compact('editmode', 'editother', 'edituser'));
        }
    }

    public function userdetail($id)
    {
        $user = User::where('users.id', $id)->first();

        return view('admin.usersdetail', compact('user'));
    }

    public function subadmindetail($id)
    {
        $subadminlist = DB::table('users')
            ->select('users.*')
            ->where('users.id', $id)->get();

        $subadmin = $subadminlist[0];

        return view('admin.subadmindetail', compact('subadmin'));
    }

    public function takeremote(Request $request, $id)
    {

        $adminid = Auth::user()->id;

        $adminrole = Auth::user()->role;
        if (strlen($id) > 5) {
            $id = substr($id, 5);
            $edituser = User::find($id);
            $editother = true;
        }
        Auth::loginUsingId($id);

        session(['isadmincontrol' => $adminid, 'rolecontrol' => $adminrole, 'returnurl' => url()->previous()]);
        print_r(session()->all());

        if (Auth::user()->role == 'admin' or Auth::user()->role == 'subadmin') {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        } else if (Auth::user()->role == 'buyer') {
            return redirect()->intended(RouteServiceProvider::USER);
        } else if (Auth::user()->role == 'seller' or Auth::user()->role == 'idlehost') {
            return redirect()->intended(RouteServiceProvider::SELLER);
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    public function shoptakeremote(Request $request, $id)
    {

        $adminid = Auth::user()->id;

        $adminrole = Auth::user()->role;

        if (strlen($id) > 5) {
            $id = substr($id, 5);

            $edituser = User::find($id);

            $editother = true;
        }

        Auth::loginUsingId($id);

        session(['isadmincontrol' => $adminid, 'rolecontrol' => $adminrole, 'returnurl' => url()->previous()]);
        print_r(session()->all());

        if (Auth::user()->role == 'admin' or Auth::user()->role == 'subadmin') {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        } else if (Auth::user()->role == 'buyer') {
            return redirect()->intended(RouteServiceProvider::USER);
        } else if (Auth::user()->role == 'seller' or Auth::user()->role == 'idlehost') {
            return redirect()->intended(RouteServiceProvider::SELLER);
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    public function indexstatus(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->status = $request->status;
        $product->save();
        return redirect()->back();
    }
    public function indexshopstatus(Request $request)
    {
        $shop = Seller::find($request->shop_id);
        $shop->status = $request->status;
        $shop->save();
        Product::where('seller_id', $shop->user_id)->update(['status' => $request->status]);
        return redirect()->back();
    }

    public function indextransferstatus(Request $request)
    {
        $transfer = Transfer::find($request->transfer_id);
        $transfer->status = $request->status;
        $transfer->payment = $request->payment;
        $transfer->save();
        return redirect()->back();
    }

    // Active and InActive Coupon Status
    public function indexcouponstatus(Request $request)
    {
        $coupon = Coupon::find($request->coupon_id);
        $coupon->status = $request->status;
        $coupon->save();

        if ($request->status == 0) {
            $shop = Seller::where('coupon_id', $request->coupon_id)->get();
            if ($shop) {
                foreach ($shop as $sh) {
                    $sh->coupon_status = 0;
                    $sh->save();
                }
            }
            $product = Product::where('coupon_id', $request->coupon_id)->get();
            if ($product) {
                foreach ($product as $pr) {
                    if ($pr->coupon_status == 0) {
                        $pr->coupon_id = null;
                        $pr->save();
                    } else {
                        $pr->coupon_status = 0;
                        $pr->save();
                    }
                }
            }
        } else {
            $product = Product::where('coupon_id', $request->coupon_id)->get();
            if ($product) {
                foreach ($product as $pr) { {
                        $pr->coupon_status = 1;
                        $pr->save();
                    }
                }
            }
            $shop = Seller::where('coupon_id', $request->coupon_id)->get();
            if ($shop) {
                foreach ($shop as $sh) {
                    $sh->coupon_status = 1;
                    $sh->save();
                    $shopProducts = Product::where('seller_id', $sh->user_id)->where('coupon_status', 0)->whereNull('coupon_id')->get();
                    foreach ($shopProducts as $shProd) {
                        $shProd->coupon_id = $sh->coupon_id;
                        $shProd->save();
                    }
                }
            }
        }

        return redirect('/admin/profile')->back();
    }

    public function  indexsubadminstatus(Request $request)
    {
        $user = User::find($request->userid);
        $user->status = $request->status;
        $user->save();
        return redirect('/admin/profile')->back();
    }



    public function indexuserstatus(Request $request)
    {
        $user = User::find($request->userid);
        $user->status = $request->status;
        $user->save();

        return redirect('/admin/profile')->back();
    }

    public function indexreviewstatus(Request $request)
    {
        $user = Review::find($request->review_id);
        $user->status = $request->status;
        $user->save();
        return redirect('/admin/profile')->back();
    }

    public function indexshoplist(Request $request)
    {
        $limit = 12;

        $lists = Seller::with('user')->with('user.products')->with('user.products.reviews')
            ->where('status', 1)->paginate($limit);

        $ratingWithProductCount = [];
        foreach ($lists as $shop => $seller) {
            $ratingWith = 0;
            $reviewCount = 0;
            $productStarReview = 0;
            $productCount = 0;
            if ($seller->user->products->isNotEmpty()) {
                foreach ($seller->user->products as $product) {
                    if ($product->reviews->isNotEmpty()) {
                        foreach ($product->reviews as $review) {
                            $ratingWith += $review->stars_rated;
                            $reviewCount++;
                        }
                        $productStarReview += $ratingWith / $product->reviews->count();
                        $ratingWith = 0;
                    }
                    $productCount++;
                }
            }
            if ($productStarReview > 0) {
                $ratingWithProductCount[$shop][0] = floor($productStarReview / $productCount);
                $ratingWithProductCount[$shop][1] = $reviewCount;
            } else {
                $ratingWithProductCount[$shop][0] = 0;
                $ratingWithProductCount[$shop][1] = 0;
            }
        }

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('front-end.seller-grid', compact('lists', 'ttlpage', 'ttl', 'ratingWithProductCount'));
    }


    public function storeReply(Request $request)
    {
        $help = new Help();

        if (!empty($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }

        $check = Help::find($request->id);
        $shopName = Seller::where('user_id', $check->help_id)->value('shop_name');
        $seller_name = DB::table('users')->select('name')->where('id', $check->help_id)->first();
        $seller_email = DB::table('users')->select('email')->where('id', $check->help_id)->first();
        $help->help_id = $check->help_id;
        $help->name = $seller_name->name;
        $help->shop_name =   $shopName;
        $help->to =  $check->to == Auth::user()->email ? $check->from : $check->to;
        $help->from = Auth::user()->email;
        $help->subject = $check->subject;
        $help->body =  $request->body;
        $help->img = $imageName;
        $help->updated_at = Carbon::now();
        $help->save();

        $adminemail =  Auth::user()->email;
        $helpDate = Carbon::now()->format('M d, Y');

        $data = [
            'title' => $check->subject,
            'content' => $request->body,
            'imgName' => $imageName,
            'helpDate' => $helpDate,
            'adminemail' => $adminemail,
            'sellername' => $seller_name->name
        ];

        \Mail::to($seller_email)->send(new \App\Mail\AdminContact($data));

        SellerNotification::create([
            'seller_id' => $help->help_id,
            'related_id' => $help->id,
            'message' => 'A new contact added:',
            'time' => Carbon::now(),
            'seen' => 0,
        ]);

        $msg = ('Reply message sent successfully');
        return redirect('/admin/indexhelp')->with('success', $msg);
    }

    public function helpDetail($id)
    {
        $start = Help::find($id);
        if ($start) {
            if ($start->to == 'all') {
                $reply = Help::where('to', 'all')->where('subject', $start->subject)->get();
            } else {
                $reply = Help::where('help_id', $start->help_id)->where('subject', $start->subject)->get();
            }
        } else {
            $reply = null;
        }

        return view('admin.helpdetail', compact('start', 'reply'));
    }

    public function storenewsletter(Request $request)
    {
        $time = new DateTime();

        $existingEmail = DB::table('newsletters')
            ->where('email', $request->newsletter)
            ->exists();

        if ($existingEmail) {
            $msg = trans('messages.duplicate_email_error_message');
            return redirect('/')->with('error', $msg);
        }

        DB::table('newsletters')->insert([
            'email' => $request->newsletter,
            'created_at' => $time->format('Y-m-d H:i:s'),
            'updated_at' => $time->format('Y-m-d H:i:s')
        ]);

        $msg = trans('messages.sending_newsletter_mail_successfully');
        return redirect('/')->with('success', $msg);
    }

    public function storeblog(Request $request)
    {
        if (!empty($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }

        $time = new DateTime();

        if (empty($request->id)) {

            DB::table('blogs')->insert([
                'title' => $request->title,
                'content' => $request->content_desc,
                'image' => $imageName,
                'created_by' => Auth::user()->id,
                'author' => Auth::user()->name,
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s')
            ]);


            $msg = trans('Register Successfully', ['name' => $request->title]);
            return redirect('/admin/all/blog')->with('success', $msg);
        } else {
            $updval = array(
                'title' => $request->title,
                'content' => $request->content_desc,
                'created_by' => Auth::user()->id,
                'author' => Auth::user()->name,
                'updated_at' => $time->format('Y-m-d H:i:s')
            );

            if (!empty($request->image)) {
                $updval['image'] = $imageName;
            }

            DB::table('blogs')->where('id', $request->id)->update($updval);

            return redirect('/admin/all/blog')->with('success', 'Updated Successfully.');
        }
    }

    public function storefaq(Request $request)
    {
        $time = new DateTime();

        if (empty($request->id)) {

            DB::table('faqs')->insert([
                'title' => $request->title_eng,
                'jptitle' => $request->title_japan,
                'que' => $request->content,
                'jpque' => $request->jpcontent_desc,
                'ans' => $request->content_ansdesc,
                'jpans' => $request->jpcontent_ansdesc,
                'created_by' => Auth::user()->id,
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s')
            ]);

            $msg = trans('Register Successfully', ['name' => $request->title]);
            return redirect('/admin/faq')->with('success', $msg);
        } else {

            $updval = array(
                'title' => $request->title_eng,
                'jptitle' => $request->title_japan,
                'que' => $request->content,
                'jpque' => $request->jpcontent_desc,
                'ans' => $request->content_ansdesc,
                'jpans' => $request->jpcontent_ansdesc,
                'updated_at' => $time->format('Y-m-d H:i:s')
            );

            DB::table('faqs')->where('id', $request->id)->update($updval);
            return redirect('admin/faq')->with('success', __('FAQ Updated Successfully'));
        }
    }

    public function indexfaq()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Faq::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->orWhere('title', 'like', '%' . $mainSearch . '%')
                    ->orWhere('ans', 'like', '%' . $mainSearch . '%')
                    ->orWhere('que', 'like', '%' . $mainSearch . '%')
                    ->orWhere('created_at', 'like', '%' . $mainSearch . '%');
            });
        }
        $faqlists = $query->orderBy('created_at', 'desc')->paginate($limit);
        $ttl = $faqlists->total();
        $ttlpage = (ceil($ttl / $limit));
        $lists = $query->orderBy('created_at', 'desc')->paginate(999);

        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('admin.indexfaq', compact('faqlists', 'ttlpage', 'ttl'));
            }
        }

        return view('front-end.faq', compact('lists'));
    }

    public function indexcoupon()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = Coupon::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->orWhere('name', 'like', '%' . $mainSearch . '%')
                    ->orWhere('coupon_code', 'like', '%' . $mainSearch . '%')
                    ->orWhere('discount_amount', 'like', '%' . $mainSearch . '%')
                    ->orWhere('mini_amount', 'like', '%' . $mainSearch . '%')
                    ->orWhere('valid_count', 'like', '%' . $mainSearch . '%')
                    ->orWhere('startdate', 'like', '%' . $mainSearch . '%')
                    ->orWhere('enddate', 'like', '%' . $mainSearch . '%')
                    ->orWhere('created_at', 'like', '%' . $mainSearch . '%');
            });
        }
        $lists = $query->orderBy('created_at', 'desc')->paginate($limit);
        foreach ($lists as $list) {
            // Check if the enddate has passed
            if (Carbon::parse($list->enddate)->isPast()) {
                // Update the status to 0
                $list->status = 0;
                $list->save();
            }
        }
        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.indexcoupon', compact('lists', 'ttlpage', 'ttl'));
    }

    public function indexuser()
    {
        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = User::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->orWhere('name', 'like', '%' . $mainSearch . '%')
                    ->orWhere('email', 'like', '%' . $mainSearch . '%')
                    ->orWhere('role', 'like', '%' . $mainSearch . '%')
                    ->orWhere('created_at', 'like', '%' . $mainSearch . '%');
            });
        }

        $users = $query->whereIn('role', ['seller', 'buyer'])
            ->whereNotNull('email_verified_at')
            ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $users->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.users', compact('users', 'ttlpage', 'ttl'));
    }

    public function indexsubadmin()
    {

        if (Auth::user()->id != '1') {
            abort(403, 'Unauthorized action.');
        }

        $limit = 10;
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $mainSearch = $validated['mainSearch'] ?? null;
        $query = User::query();
        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->orWhere('name', 'like', '%' . $mainSearch . '%')
                    ->orWhere('email', 'like', '%' . $mainSearch . '%')
                    ->orWhere('role', 'like', '%' . $mainSearch . '%')
                    ->orWhere('created_at', 'like', '%' . $mainSearch . '%');
            });
        }

        $subadmins = $query->where('role', 'admin')
            ->where('id', '!=', 1)
            ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $subadmins->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.subadmin', compact('subadmins', 'ttlpage', 'ttl'));
    }


    public function registersubadmin(Request $request)
    {
        $validator = $this->validatesubadmin($request);

        if ($request->ajax()) {

            if ($validator->passes()) {

                return response()->json(['success' => 'allpasses']);
            }
            return response()->json(['error' => $validator->errors()]);
        }

        //*******************************************************

        if (empty($request->role)) {
            $role = 'admin';
        } else {
            $role = $request->role;
        }

        if (!empty($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }

        $user = User::create([
            'role' => $role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'user_photo' => $imageName,
        ]);

        event(new Registered($user));

        return redirect('admin/subadmin')->with('success', 'Registered Successfully');
    }

    public function indexsubtitle()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }

        $lists = DB::table('sub_category_titles')
            ->select('C.category_name as category', 'sub_category_titles.*')
            ->join('categories as C', function ($join) {
                $join->on('sub_category_titles.category_id', '=', 'C.id');
            })
            ->orderBy('created_at', 'desc')->paginate($limit);


        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.allsubtitle', compact('lists', 'ttlpage', 'ttl'));
    }

    public function deleteNotice(Request $request)
    {
        $id = $request->id;
        $help = Help::findOrFail($id);
        $imagePath = public_path('images/' . $help->img);
        $help->delete();
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $msg = ('Data deleted successfully');
        return redirect()->back()->with('success', $msg);
    }

    public function deletecategory(Request $request)
    {
        if ($request->type == '1') {
            Category::where('id', $request->id)->delete();
        } elseif ($request->type == '2') {
            $cat = SubCategoryTitle::find($request->id);
            $categoryId = $cat->category_id;
            DB::table('sub_category_titles')->where('id', $request->id)->delete();
            $categoryIdExist = SubCategoryTitle::where('category_id', $categoryId)->exists();
            if (!$categoryIdExist) {
                Category::where('id', $categoryId)->delete();
            }
        } else {
            $updatedRows = Product::where('special_sub_category_id', $request->id)
                                    ->update(['special_sub_category_id' => null]);
            SubCategory::where('id', $request->id)->delete();
        }
        return redirect()->back()->with('success', 'Deleted Successfully.');
    }

    public function deleteblog(Request $request)
    {

        $data = DB::table('blogs')
            ->delete($request->id);
        return redirect()->back()->with('success', 'Deleted Successfully.');
    }

    // reset product commission
    public function deletecommission(Request $request)
    {
        $item = Product::find($request->id);
        $shop = Seller::where('user_id', $item->seller_id)->first();
        $item->commission_status = 0;
        $item->commission = $shop->commission;
        $item->save();
        return redirect()->back()->with('success', 'Deleted Successfully.');
    }


    public function deletenewsletter(Request $request)
    {

        $data = DB::table('newsletters')
            ->delete($request->id);
        return redirect()->back()->with('success', 'Deleted Successfully.');
    }

    public function deleteorderlist(Request $request)
    {

        $data = DB::table('orders')
            ->delete($request->id);
        return redirect()->back()->with('success', '削除されました。');
    }

    public function deletecoupon(Request $request)
    {

        $data = DB::table('coupons')
            ->delete($request->id);
        return redirect()->back()->with('success', '削除されました。');
    }

    public function deletefaq(Request $request)
    {

        $data = DB::table('faqs')
            ->delete($request->id);
        return redirect()->back()->with('success', '削除されました。');
    }

    public function deleteproduct(Request $request)
    {

        $data = DB::table('products')
            ->delete($request->id);
        return redirect()->back()->with('success', '削除されました。');
    }

    // update coupon for shop
    public function  updatecoupon(Request $request)
    {
        $time = new DateTime();

        $seller = Seller::find($request->id);
        $seller->update([
            'coupon_status' => 1,
            'coupon_id' => $request->couponid,
            'updated_at' => $time->format('Y-m-d H:i:s'),
        ]);

        $products = Product::where('seller_id', $seller->user_id)->where('coupon_status', 0)->get();
        foreach ($products as $product) {
            $product->update(['coupon_id' => $request->couponid]);
        }

        return redirect('/admin/shoplist')->with('success', 'coupon added');
    }

    public function  updatecommission(Request $request)
    {
        // Retrieve the input values
        $commission = $request->input('commission');

        $commissionId = $request->input('commissionid');

        // Process the data (e.g., update the database)
        $item = Seller::find($commissionId);

        if ($item) {
            $item->commission = $commission;
            $item->save();
        }
        $products = Product::where('seller_id', $item->user_id)
            ->where(function ($query) {
                $query->where('commission_status', '!=', 1)
                    ->orWhereNull('commission_status');
            })
            ->get();

        foreach ($products as $item) {
            $item->commission =   $commission;
            $item->commission_status =   0;
            $item->save();
        }

        return redirect('/admin/shoplist')->with('success', 'commission added');
    }

    public function  updateadjust(Request $request)
    {
        $adjust = $request->input('adjust');
        $adjustId = $request->input('adjustId');
        $item = Transfer::find($adjustId);

        if ($item) {
            $item->adjust_amount = $adjust;
            $item->save();
        }
        return redirect('/admin')->with('success', 'adjust added');
    }

    public function  updateproductcommission(Request $request)
    {
        // Retrieve the input values
        $commission = $request->input('commission');

        $commissionId = $request->input('commissionid');

        // Process the data (e.g., update the database)
        $item = Product::find($commissionId);

        if ($item) {
            $item->commission = $commission;
            $item->commission_status = 1;
            $item->save();
        }

        return redirect('/admin/product')->with('success', 'commission added');
    }

    public function  updatesubcatname(Request $request)
    {
        // Retrieve the input values
        $subcat = $request->input('subcat');
        $subcatJp = $request->input('subcatJp');

        $subcatId = $request->input('subcatid');
        // Process the data (e.g., update the database)
        $item = SubCategoryTitle::find($subcatId);

        if ($item) {
            $item->sub_category_titlename = $subcat;
            $item->sub_category_titlename_jp = $subcatJp;
            $item->save();
        }

        return redirect('/admin/category')->with('success', 'updated subcategory');
    }

    public function  updatecategoryname(Request $request)
    {
        // Retrieve the input values
        $category = $request->input('category');
        $categoryJp = $request->input('categoryJp');

        $categoryId = $request->input('categoryid');
        // Process the data (e.g., update the database)
        $item = Category::find($categoryId);

        if ($item) {
            $item->category_name = $category;
            $item->category_name_jp = $categoryJp;
            $item->save();
        }

        return redirect('/admin/category')->with('success', 'updated category');
    }


    // update coupon for product
    public function  updateproductcoupon(Request $request)
    {
        $time = new DateTime();
        $updval = array(
            'coupon_id' => $request->couponid,
            'coupon_status' => 1,
            'updated_at' => $time->format('Y-m-d H:i:s')
        );

        DB::table('products')->where('id', $request->id)->update($updval);

        return redirect('/admin/product')->with('success', 'coupon added');
    }



    public function deleteuser(Request $request)
    {

        $data = DB::table('users')
            ->delete($request->id);
        return redirect('/admin/all/users')->with('success', '削除されました。');
    }

    public function deletesubadmin(Request $request)
    {
        $data = DB::table('users')
            ->delete($request->id);
        return redirect('/admin/subadmin')->with('success', '削除されました。');
    }
    public function addsubtitle()
    {
        $categories = DB::table('categories')
            ->select('categories.*')
            ->orderBy('categories.created_at', 'asc')->get();
        return view('admin.addsubtitle', compact('categories'));
    }

    public function addsubcategory()
    {
        $categories = DB::table('categories')
            ->select('categories.*')
            ->orderBy('categories.created_at', 'asc')->get();
        return view('admin.addsubcategory', compact('categories'));
    }

    public function editcategory($id)
    {

        $data = DB::table('categories')
            ->find($id);
        $editmode = true;

        return view('admin.addcategory', compact('data', 'editmode'));
    }

    public function edittop($id)
    {

        $data = DB::table('tops')
            ->find($id);
        $editmode = true;
        return view('admin.registertop', compact('data', 'editmode'));
    }

    public function editcustomer($id)
    {

        $data = DB::table('customers')
            ->find($id);
        $editmode = true;

        return view('admin.customer', compact('data', 'editmode'));
    }

    public function editblog($id)
    {
        $data = DB::table('blogs')
            ->find($id);
        $editmode = true;

        return view('admin.blog.addblog', compact('data', 'editmode'));
    }

    public function edithelp($id)
    {
        $data = DB::table('helps')
            ->find($id);
        $editmode = true;

        return view('admin.addhelp', compact('data', 'editmode'));
    }

    public function addhelp()
    {
        $data = DB::table('users')
            ->select('users.*')
            ->where('role', 'seller')
            ->get();

        return view('admin.addhelp', compact('data'));
    }

    public function addnotice()
    {

        return view('admin.addnotice');
    }

    public function editcoupon($id)
    {
        $data = DB::table('coupons')
            ->find($id);
        $editmode = true;

        return view('admin.addcoupon', compact('data', 'editmode'));
    }

    public function editfaq($id)
    {
        $faq = DB::table('faqs')
            ->find($id);
        $editmode = true;

        return view('admin.registerfaq', compact('faq', 'editmode'));
    }

    public function updateMultiImg(Request $request)
    {
        $id = $request->product_id;
        if ($request->has('multi_img')) {
            foreach ($request->multi_img as $id => $img) {
                if ($img->isValid()) {
                    $filename = time() . '_' . rand(100, 999) . '.' . $img->getClientOriginalExtension();
                    $img->move(public_path('upload/multiImg'), $filename);

                    MultiImg::where('id', $id)->update([
                        'photo_name' => $filename,
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        if ($request->hasFile('new_img')) {
            $newImg = $request->File('new_img');
            if ($newImg->isValid()) {
                $filename = time() . '_' . rand(100, 999) . '.' . $newImg->getClientOriginalExtension();
                $newImg->move(public_path('upload/multiImg'), $filename);

                MultiImg::create([
                    'product_id' => $id,
                    'photo_name' => $filename,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        $msg = ('Image updated Successfully');
        return redirect()->back()->with('success', $msg);
    }

    public function deleteMultiImg($id)
    {
        $old_img = MultiImg::findOrFail($id);
        File::delete($old_img->photo_name);
        MultiImg::findOrFail($id)->delete();
        return redirect()->back()->with('flash_message', 'Image deleted successfully');
    }

    public function editproduct($id)
    {
        $brands = Brand::latest()->get();
        $countries = Country::latest()->get();
        $categories = Category::latest()->where('category_name', '!=', 'Special Corner')->get();
        $subcategories = SubCategory::latest()->get();
        $subcatitle = SubCategoryTitle::latest()->get();
        $products = Product::findOrFail($id);
        $multiImgs = MultiImg::where('product_id', $id)->get();

        return view('admin.editproduct', compact('brands', 'countries', 'products', 'categories', 'subcategories', 'subcatitle', 'multiImgs'));
    }

    public function editsubtitle($id)
    {
        $subtitle = DB::table('sub_category_titles')
            ->find($id);

        $categories = DB::table('categories')
            ->select('categories.*')
            ->orderBy('categories.created_at', 'asc')->get();

        $category = DB::table('categories')
            ->select('categories.*')
            ->where('id', $subtitle->sub_category_id)
            ->pluck('id')->toArray();

        $editmode = true;
        return view('admin.addsubtitle', compact('subtitle', 'categories', 'category', 'editmode'));
    }

    public function editsubcategory($type, $id)
    {
        if ($type == 3) {
            $subtitle = DB::table('sub_categories')
                ->find($id);

            $subcat_id = DB::table('sub_categories')
                ->select('sub_categories.sub_category_title_id')
                ->where('id', $id)->first();

            $subcategory_titlename = DB::table('sub_category_titles')->where('id', $subcat_id->sub_category_title_id)->first();

            $categories = DB::table('categories')
                ->select('categories.*')
                ->orderBy('categories.created_at', 'asc')->get();


            $category = DB::table('sub_category_titles')
                ->select('S.sub_category_name as subcategory_name')
                ->join('sub_categories as S', function ($join) {
                    $join->on('sub_category_titles.sub_category_id', '=', 'S.sub_category_title_id');
                })
                ->orderBy('sub_category_titles.created_at', 'desc')->get();

            $subcategory_name = DB::table('sub_categories')
                ->select('sub_categories.sub_category_name')
                ->where('id', $id)
                ->first();


            $editmode = true;

            return view('admin.editcategory', compact('subcat_id', 'subtitle', 'categories', 'subcategory_titlename', 'subcategory_name', 'editmode'));
        } else if ($type == 1) {
            $data = DB::table('categories')
                ->find($id);
            $editmode = true;

            return view('admin.addcategory', compact('data', 'editmode'));
        } else {
            $subtitle = DB::table('sub_category_titles')
                ->find($id);

            $categories = DB::table('categories')
                ->select('categories.*')
                ->orderBy('categories.created_at', 'asc')->get();

            $category = DB::table('categories')
                ->select('categories.*')
                ->where('id', $subtitle->sub_category_id)
                ->pluck('id')->toArray();

            $editmode = true;

            return view('admin.editsubcattitle', compact('subtitle', 'categories', 'category', 'editmode'));
        }
    }

    public function storesubtitle(Request $request)
    {
        $valarr = [
            'category' => 'not_in:0',
            'subtitle' => 'required|array|max:255',
        ];

        $request->validate($valarr);
        $subtitle_arr = $request->subtitle;
        $time = new DateTime();
        if (empty($request->id)) {

            foreach ($subtitle_arr as $key => $subtitle) {
                DB::table('sub_category_titles')->insertOrIgnore([
                    'category_id' => $request->category,
                    'sub_category_id' => $request->category,
                    'sub_category_titlename' => $subtitle,
                    'sub_category_titlename_jp' => $request->subtitleJp[$key],

                    'created_at' => $time->format('Y-m-d H:i:s'),
                    'updated_at' => $time->format('Y-m-d H:i:s')
                ]);
            }

            $msg = trans('Register Successfully', ['name' => 'Subtitle']);
            return redirect('/admin/category')->with('success', $msg);
        } else {


            $updval = array(
                'category_id' => $request->category,
                'sub_category_id' => $request->category,
                'sub_category_titlename' => $request->subtitle[0],
                'sub_category_titlename_jp' => $request->subtitleJp[0],
                'updated_at' => $time->format('Y-m-d H:i:s')
            );

            DB::table('sub_category_titles')->where('id', $request->id)->update($updval);

            return redirect('/admin/category')->with('success', __('Subtitle Updated Successfully'));
        }
    }


    public function storesubcategory(Request $request)
    {

        $time = new DateTime();
        $subname_arr = $request->subname;
        if (empty($request->id)) {
            foreach ($subname_arr as $key => $subname) {
                DB::table('sub_categories')->insert([
                    'category_id' => $request->category,
                    'sub_category_name' => $subname,
                    'sub_category_name_jp' => $request->subnameJp[$key],
                    'sub_category_title_id' => $request->subcategory,
                    'created_at' => $time->format('Y-m-d H:i:s'),
                    'updated_at' => $time->format('Y-m-d H:i:s')
                ]);
            }
            $msg = trans('Register Successfully', ['name' => $request->title]);
            return redirect('/admin/category')->with('success', $msg);
        } else {
            if (!empty($request->image)) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
            } else {
                $imageName = '';
            }

            if (!empty($request->image)) {
                $updvals['category_icon'] = $imageName;
            }

            $updval = array(
                'category_id' => $request->category,
                'sub_category_name' => $request->subname ?? '',
                'sub_category_name_jp' => $request->subnameJp ?? '',
                'sub_category_title_id' => $request->subcategory ?? '',
                'updated_at' => $time->format('Y-m-d H:i:s')
            );
            if (!empty($request->image)) {
                DB::table('categories')->where('id', $request->category)->update($updvals);
            }
            DB::table('sub_categories')->where('id', $request->id)->update($updval);
            return redirect('/admin/category')->with('success', __('SubCategory Updated Successfully'));
        }
    }

    public function contact(Request $request)
    {
        if ($request->from == 'faq') {
            $inquiry_email = 'info-test@asia-hd.com';

            $data = array('name' => $request->name);

            $adminemail =  'admin@asia-hd.com';
            $faqDate = Carbon::now()->format('M d, Y');

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'content' => $request->message,
                'faqDate' => $faqDate,
                'adminemail' => $adminemail
            ];

            $adminMails = DB::table('users')->where('role', 'admin')->pluck('email')->toArray();;
            if (!empty($adminMails)) {
                foreach ($adminMails as $email) {
                    $data = [
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'content' => $request->message,
                        'faqDate' => $faqDate,
                        'adminemail' => $adminemail
                    ];
                    \Mail::to($email)->send(new \App\Mail\FAQContact($data));
                }
            }

            return redirect('/faq#ts-form')->with('success', 'Your message has been successfully sent.');
        } else if ($request->from == 'contact') {
            $adminemail =  'admin@asia-hd.com';
            $contactDate = Carbon::now()->format('M d, Y');

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'content' => $request->message,
                'contactDate' => $contactDate,
                'adminemail' => $adminemail
            ];

            $adminMails = DB::table('users')->where('role', 'admin')->pluck('email')->toArray();;
            if (!empty($adminMails)) {
                foreach ($adminMails as $email) {
                    $data = [
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'content' => $request->message,
                        'contactDate' => $contactDate,
                        'adminemail' => $adminemail
                    ];
                    \Mail::to($email)->send(new \App\Mail\GuestContact($data));
                }
            }
            return redirect('/contact#contact-form')->with('success', 'Your message has been successfully sent.');
        }
    }

    public function notice(Request $request)
    {
        $seller_name = DB::table('users')->select('name')->where('id', $request->selleremail)->first();
        $seller_email = DB::table('users')->select('email')->where('id', $request->selleremail)->first();
        $shopName = Seller::where('user_id', $request->selleremail)->value('shop_name');

        if (!empty($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }
        $seller_email =  $seller_email->email;
        $help = new Help();
        $help->name = $seller_name->name;
        $help->shop_name =  $shopName;
        $help->help_id = $request->selleremail;
        $help->to = $seller_email;
        $help->from = 'admin@asia-hd.com';
        $help->subject = $request->title;
        $help->body =  $request->message;
        $help->img = $imageName;
        $help->created_at = Carbon::now();
        $help->save();
        $adminemail = 'admin@asia-hd.com';
        $helpDate = Carbon::now()->format('M d, Y');

        $data = [
            'title' => $request->title,
            'content' => $request->message,
            'imgName' => $imageName,
            'helpDate' => $helpDate,
            'adminemail' => $adminemail,
            'sellername' => $seller_name->name
        ];

        $sellers = User::where('id', $request->selleremail)->orWhere('created_by', $request->selleremail)->get();
        foreach ($sellers as $seller) {
            \Mail::to($seller->email)->send(new \App\Mail\AdminContact($data));
        }

        SellerNotification::create([
            'seller_id' => $request->selleremail,
            'related_id' => $help->id,
            'message' => 'A new contact added:',
            'time' => Carbon::now(),
            'seen' => 0,
        ]);

        return redirect('/admin/indexhelp')->with('success', 'Sending Email successfully');
    }

    public function noticeall(Request $request)
    {

        $sellers = User::where('role', 'seller')
            ->get();

        if (!empty($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }

        // Create Help records for each seller
        foreach ($sellers as $seller) {
            if ($seller->created_by) {
                $seller_name = Seller::where('user_id', $seller->created_by)->first();
            } else {
                $seller_name = Seller::where('user_id', $seller->id)->first();
            }
            $help = new Help();
            $help->name = $seller->name;
            $help->shop_name = $seller_name->shop_name;
            $help->to = $seller->email;
            $help->noshow = 1;
            $help->help_id =  $seller->id;
            $help->from = Auth::user()->email;
            $help->subject = $request->title;
            $help->body = $request->message;
            $help->img =  $imageName;
            $help->created_at = Carbon::now();
            $help->save();
        }
        $help = new Help();
        $help->name = 'all';
        $help->to = 'all';
        $help->noshow = 1;
        $help->from = Auth::user()->email;
        $help->subject = $request->title;
        $help->body = $request->message;
        $help->img =  $imageName;
        $help->created_at = Carbon::now();
        $help->save();

        foreach ($sellers as $seller) {
            SellerNotification::create([
                'seller_id' => $seller->id,
                'related_id' => $help->id,
                'message' => 'A new contact added:',
                'time' => Carbon::now(),
                'seen' => 0,
            ]);
        }

        return redirect('/admin/indexhelp')->with('success', 'Sending Email successfully');
    }

    public function storetop(Request $request)
    {
        if (!empty($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }

        $time = new DateTime();

        $updval = array(
            'phaseone' => $request->phaseone,
            'phasetwo' => $request->phasetwo,
            'phasethree' => $request->phasethree,
            'updated_at' => $time->format('Y-m-d H:i:s')
        );

        if (!empty($request->image)) {
            $updval['image'] = $imageName;
        }

        DB::table('tops')->where('id', $request->id)->update($updval);

        return redirect('/admin/top')->with('success', 'Successfully updated!');
    }


    public function storecustomer(Request $request)
    {
        if (!empty($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }

        $time = new DateTime();

        $updval = array(
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $request->content,
            'name' => $request->name,
            'position' => $request->position,
            'updated_at' => $time->format('Y-m-d H:i:s')
        );

        if (!empty($request->image)) {
            $updval['image'] = $imageName;
        }

        DB::table('customers')->where('id', $request->id)->update($updval);

        return redirect('/admin/indexcustomer')->with('success', 'Successfully updated!');
    }



    public function storecoupon(Request $request)
    {

        $existingCoupon = DB::table('coupons')
            ->where('coupon_code', $request->code)
            ->exists();

        if ($existingCoupon && empty($request->id)) {

            $request->validate([
                'code' => 'required|string|max:255|unique:coupons,coupon_code',
            ], [
                'code.required' => 'Code is required.',
                'code.unique' => 'Coupon code "' . $request->code . '" already exists. Please choose a different one.',
            ]);
        }

        if (empty($request->id)) {
            $request->validate(
                [
                    'title' => 'required|string|max:255',
                    'code' => 'required|string|max:255',
                    'disamount' => 'required|numeric|max:9999999999.999999',
                    'miniamount' => 'required|numeric|max:9999999999.999999',
                    'validcount' => 'required|numeric|max:9999999999.999999',
                    'startdate' => 'required|date',
                    'enddate' => 'required|date',
                ],
                [
                    'code.required' => 'code is required',
                    'disamount.required' => 'disamount is required',
                    'miniamount.required' => 'miniamount is required',
                    'validcount.required' => 'validcount is required',
                    'validdate.required' => 'validdate is required',
                ]
            );
        }

        $time = new DateTime();

        if ($existingCoupon == false && empty($request->id)) {

            DB::table('coupons')->insert([
                'name' => $request->title,
                'coupon_code' => $request->code,
                'discount_amount' => $request->disamount,
                'mini_amount' => $request->miniamount,
                'valid_count' => $request->validcount,
                'used_count' => 0,
                'startdate' => $request->startdate,
                'enddate' => $request->enddate,
                'status' => '1',
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s')

            ]);

            $msg = trans('Coupon Register Successfully', ['name' => $request->title]);
            return redirect('/admin/coupon')->with('success', $msg);
        } else {

            $updval = array(
                'name' => $request->title,
                'coupon_code' => $request->code,
                'discount_amount' => $request->disamount,
                'mini_amount' => $request->miniamount,
                'valid_count' => $request->validcount,
                'startdate' => $request->startdate,
                'enddate' => $request->enddate,
                'updated_at' => $time->format('Y-m-d H:i:s')
            );

            DB::table('coupons')->where('id', $request->id)->update($updval);

            return redirect('/admin/coupon')->with('success', 'Updated Successfully');
        }
    }

    public function storeproduct(Request $request)
    {

        $time = new DateTime();

        //commision calculate
        $originalPrice = $request->selling_price;
        $discountPercentage = $request->discount_percent;
        $discountAmount = ($originalPrice * $discountPercentage) / 100;
        $discountedPrice = $originalPrice - $discountAmount;
        $product = Product::find($request->id);
        $old_img = $request->old_img;
        $request->validate([
            'country_id'  => 'required|exists:countries,id',
            'category_id' => 'required|exists:categories,id',
            'sub_category_title_id' => 'present|exists:sub_category_titles,id',
            'sub_category_id' => 'present|exists:sub_categories,id',
            'product_name' => 'required|string',
            'product_qty' => 'required|numeric',
            'product_tags' => 'required|string|max:255',
            'product_size' => 'required|string|max:255',
            'product_color' => 'required|string|max:255',
            'original_price' => 'required|numeric',
            'short_desc' => 'required|string',
            'long_desc' => 'required|string',
            'care_instructions' => 'required|string',
            'estimate_date' => 'required|string',
            'shipping_country' => 'required',
        ]);

        if ($request->hasFile('product_thambnail')) {
            if (File::exists($old_img)) {
                File::delete($old_img);
            }
            $img = $request->file('product_thambnail');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('images'), $filename);
        } else {
            $filename = $old_img;
        }
        $product->brand_id = $request->brand_id;
        $product->country_id = $request->country_id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->sub_category_title_id = $request->sub_category_title_id;
        $product->product_name = $request->product_name;
        $product->product_qty = $request->product_qty;
        $product->in_stock = $request->product_qty;
        $product->product_tags = $request->product_tags;
        $product->product_size = $request->product_size;
        $product->product_color = $request->product_color;
        $product->original_price = $request->original_price;
        $product->discount_percent = $request->discount_percent ?? 0;
        $product->selling_price = $request->calculated_selling_price;
        $product->short_desc = $request->short_desc;
        $product->long_desc = $request->long_desc;
        $product->care_instructions = $request->care_instructions;
        $product->product_thambnail = $filename;
        $product->estimate_date = $request->estimate_date;
        // $product->status= 1;
        $product->delivery_price = $request->delivery_price;
        $product->shipping_country = $request->shipping_country;
        $product->updated_by = Auth::user()->id;
        $product->updated_at = Carbon::now();
        $product->update();
        $msg = ('Product updated Successfully');
        return redirect('/admin/product')->with('success', 'Successfully updated!');
    }


    public function storecategory(Request $request)
    {

        $valarr = array('title' => 'required|string|max:255',);

        if (empty($request->id)) {
            $valarr['image'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $request->validate($valarr);

        if (!empty($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }

        $time = new DateTime();

        if (empty($request->id)) {

            DB::table('categories')->insert([
                'category_name' => $request->title,
                'category_name_jp' => $request->titleJp,
                'category_icon' => $imageName,
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s')
            ]);

            $msg = trans('Register Successfully', ['name' => $request->title]);
            return redirect('/admin/category')->with('success', $msg);
        } else {

            $updval = array(
                'category_name' => $request->title,
                'updated_at' => $time->format('Y-m-d H:i:s')
            );

            if (!empty($request->image)) {
                $updval['category_icon'] = $imageName;
            }

            DB::table('categories')->where('id', $request->id)->update($updval);

            return redirect('/admin/category')->with('success', 'Updated Successfully.');
        }
    }

    public function getSubcategories(Request $request)
    {

        $subcategories =   DB::table('sub_category_titles')->where('category_id', '=', $request->category)->get();
        return response()->json([
            'status' => 'success',
            'subcategories' => $subcategories,
        ]);
    }

    public function indexorderlist()
    {
        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);

        $mainSearch = $validated['mainSearch'] ?? null;
        $limit = 10;

        $orderQuery = OrderDetail::with('order')
            ->where('status', '!=', 'Cancel')
            ->where('status', '!=', 'Cash Cancel')
            ->groupBy('order_id')
            ->selectRaw('order_id, MAX(created_at) as created_at, MAX(id) as id, MAX(amount) as amount, MAX(status) as status')
            ->orderBy('created_at', 'desc');

        if ($mainSearch) {
            $orderQuery->where(function ($orderQuery) use ($mainSearch) {
                $orderQuery->where('order_id', 'LIKE', "%{$mainSearch}%")
                    ->orWhere('status', 'LIKE', "%{$mainSearch}%")
                    ->orWhereHas('order', function ($orderQuery) use ($mainSearch) {
                        $orderQuery->where('order_code', 'LIKE', "%{$mainSearch}%")
                            ->orWhere('payment_type', 'LIKE', "%{$mainSearch}%");
                    });
            });
        }

        $order = $orderQuery->paginate($limit);
        $cancelledOrderQuery = OrderDetail::with('order')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select('order_details.*', 'products.*', 'order_details.status as order_detail_status')
            ->where('order_details.status', 'like', '%Cancel%')
            ->orderBy('order_details.created_at', 'desc');

        if ($mainSearch) {
            $cancelledOrderQuery->where(function ($cancelledOrderQuery) use ($mainSearch) {
                $cancelledOrderQuery->where('order_id', 'LIKE', "%{$mainSearch}%")
                    ->orWhereHas('order', function ($cancelledOrderQuery) use ($mainSearch) {
                        $cancelledOrderQuery->where('order_code', 'LIKE', "%{$mainSearch}%");
                    })
                    ->orWhere('products.product_name', 'LIKE', "%{$mainSearch}%")
                    ->orWhere('products.product_code', 'LIKE', "%{$mainSearch}%");
            });
        }

        $cancelledOrder = $cancelledOrderQuery->paginate($limit);
        $ttl = $order->total();
        $ttlpage = ceil($ttl / $limit);
        $cancelttl = $cancelledOrder->total();
        $cancelttlPage = ceil($cancelttl / $limit);

        return view('admin.order.indexorderlist', compact('order', 'ttl', 'ttlpage', 'cancelledOrder', 'cancelttl', 'cancelttlPage'));
    }

    public function orderdetail($id)
    {

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
            ->where('order_details.order_id', $id)
            ->where('order_details.status', '!=', 'Cancel')
            ->get();

        return view('admin.order.orderdetail', compact('orderDetails'));
    }

    public function ordertracking($id)
    {
        $orderDetail = OrderDetail::with('prefecture')->with('seller')
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
            ->where('order_details.id', $id)
            ->first();
        return view('admin.order.ordertracking', compact('orderDetail'));
    }

    public function admindashboard()
    {
        $currentDate = Carbon::now();
        $limit = 10;
        $id = Auth::user()->created_by ?? Auth::id();
        $revenue = OrderDetail::where('status', 'Delivered')
            ->whereMonth('created_at', $currentDate->month)
            ->whereYear('created_at', $currentDate->year)
            ->sum('amount');

        $orderCount = OrderDetail::whereMonth('created_at', '=', Carbon::now()->month)->count();
        $pending = OrderDetail::where('status', 'Pending')->count();
        $currentDate = Carbon::now();

        $lastDate = Carbon::now();
        $subtractedDate = $lastDate->subDay();
        $endmonthDate = $subtractedDate;

        $product = Product::whereDate('created_at', '<=', $currentDate)->count();
        $transfers = OrderDetail::latest()->paginate($limit);
        $orders = OrderDetail::selectRaw("COUNT(*) as count, DATE_FORMAT(created_at, '%M') as month_name, MONTH(created_at) as month_number")
            ->whereYear('created_at', date('Y'))
            ->where('order_details.payment_approved', '1')
            ->groupBy(DB::raw("MONTH(created_at)"), DB::raw("DATE_FORMAT(created_at, '%M')"))
            ->orderBy(DB::raw("MONTH(created_at)"))
            ->get();

        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $data = array_fill(0, 12, 0);

        foreach ($orders as $order) {
            $monthIndex = $order->month_number - 1;
            $data[$monthIndex] = $order->count;
        }
        //half month
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthHalfEnd = Carbon::now()->startOfMonth()->setDay(15)->endOfDay();
        $previousMonthHalfStart = Carbon::now()->startOfMonth()->copy()->subMonth()->addDays(16)->subDay();
        $previousMonthEnd = Carbon::now()->startOfMonth()->copy()->subMonth()->copy()->endOfMonth();
        $lastMonthHalfDay = Carbon::now()->subMonth()->setDay(16);
        //-----//
        $halfMonthEnd = Carbon::now()->startOfMonth()->addDays(15);
        // $nextMonthstartdate = Carbon::now()->endOfMonth()->addDays(1)->format('Y-m-d');
        $nextMonthstartdate = Carbon::now()->endOfMonth();

        $transfer = [];
        $subquery = DB::table('sellers')
            ->select(
                'sellers.user_id as seller_id',
                'sellers.shop_name',
                'products.commission as product_commission',
                'products.id as product_id',
                DB::raw('(SUM(order_details.amount) * (1 - products.commission / 100) +
                                        SUM(CASE WHEN order_details.used_delivery_price = 1 THEN order_details.delivery_price ELSE 0 END)) as seller_amount')
            )
            ->leftJoin('order_details', 'order_details.seller_id', '=', 'sellers.user_id')
            ->leftJoin('products', 'order_details.product_id', '=', 'products.id')
            ->where('order_details.payment_approved', '1')
            ->whereBetween("order_details.created_at", [$currentMonthStart, $currentMonthHalfEnd])
            ->groupBy('sellers.user_id', 'sellers.shop_name', 'products.commission', 'products.id');

        $next_subquery = DB::table('sellers')
            ->select(
                'sellers.user_id as seller_id',
                'sellers.shop_name',
                'products.commission as product_commission',
                // 'products.id as product_id',
                DB::raw('(SUM(order_details.amount) * (1 - products.commission / 100) +
                                        SUM(CASE WHEN order_details.used_delivery_price = 1 THEN order_details.delivery_price ELSE 0 END)) as seller_amount')
            )
            ->leftJoin('order_details', 'order_details.seller_id', '=', 'sellers.user_id')
            ->leftJoin('products', 'order_details.product_id', '=', 'products.id')
            ->where('order_details.payment_approved', '1')
            ->whereBetween('order_details.created_at', [$previousMonthHalfStart, $previousMonthEnd])
            ->groupBy('sellers.user_id', 'sellers.shop_name', 'products.commission');

        if ($currentDate > $currentMonthHalfEnd && $currentDate <= Carbon::now()->endOfMonth()) {

            $transfer = Seller::rightJoin(DB::raw("({$subquery->toSql()}) as P"), function ($join) {
                $join->on('P.seller_id', '=', 'sellers.user_id');
            })
                ->mergeBindings($subquery)
                ->select(
                    'sellers.user_id',
                    'sellers.commission',
                    DB::raw('MAX(sellers.shop_name) AS shop_name'),
                    DB::raw('SUM(P.seller_amount) AS total_seller_amount')
                )
                ->groupBy('sellers.user_id', 'sellers.commission')
                ->paginate($limit);
        } else {
            $transfer = Seller::rightJoin(DB::raw("({$next_subquery->toSql()}) as P"), function ($join) {
                $join->on('P.seller_id', '=', 'sellers.user_id');
            })
                ->mergeBindings($next_subquery)
                ->select(
                    'sellers.user_id',
                    'sellers.commission',
                    DB::raw('MAX(sellers.shop_name) AS shop_name'),
                    DB::raw('SUM(P.seller_amount) AS total_seller_amount')
                )
                ->groupBy('sellers.user_id', 'sellers.commission')
                ->paginate($limit);
        }
        foreach ($transfer as $record) {
            $datePrefix = date('ym');
            $sequentialNumber = 1;
            // Generate the new product code
            $newProductCode = $datePrefix . str_pad($sequentialNumber, 5, '0', STR_PAD_LEFT) . $record->user_id;

            // Check if a record with the same transfer code already exists
            $existingTransfer = Transfer::where('transfer_code', $newProductCode)->first();
            if ($currentDate > $currentMonthHalfEnd && $currentDate <= Carbon::now()->endOfMonth()) {
                $transferStart = Carbon::now()->startOfMonth();
                $transferEnd = Carbon::now()->startOfMonth()->setDay(15)->endOfDay();
            } else {
                $transferStart = Carbon::now()->startOfMonth()->copy()->subMonth()->addDays(16)->subDay();
                $transferEnd = Carbon::now()->startOfMonth()->copy()->subMonth()->copy()->endOfMonth();
            }

            // If no matching record is found, create a new one
            if (!$existingTransfer) {
                Transfer::create([
                    'seller_id' => $record->user_id,
                    'shop_name' => $record->shop_name,
                    'commission' => $record->commission,
                    'seller_amount' => $record->total_seller_amount,
                    'transfer_code' => $newProductCode,
                    'start_date' => $transferStart,
                    'end_date' => $transferEnd,
                    'status' => 0,

                ]);
            }

            // Increment the sequential number for the next iteration
            $sequentialNumber++;
        }
        $transfer_history = Transfer::latest()->paginate($limit);
        // dd($transfer_history);
        $ttl = $transfer_history->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.index', compact('labels', 'data', 'transfer_history', 'revenue', 'orderCount', 'pending', 'product', 'ttl', 'ttlpage'));
    }

    public function detailProduct($id)
    {
        $product = Product::find($id);
        $multiImgs = MultiImg::where('product_id', $id)->get();
        return view('admin.product.product_detail', compact('product', 'multiImgs'));
    }

    public function indexhelp()
    {
        $limit = 10;

        $validated = request()->validate([
            'mainSearch' => 'string|nullable',
        ]);
        $search = $validated['mainSearch'] ?? null;

        $userEmail = Auth::user()->email;
        $receivedQuery = Help::where('to', $userEmail)
            ->select('helps.*')
            ->join(DB::raw('(SELECT MAX(id) as id FROM helps WHERE `to` = "' . $userEmail . '" GROUP BY subject, `from`) as latest_help'), function ($join) {
                $join->on('helps.id', '=', 'latest_help.id');
            });
        $sentQuery = Help::where('from', $userEmail)->where('to', '!=', 'all')
            ->select('helps.*')
            ->join(DB::raw('(SELECT MAX(id) as id FROM helps WHERE `from` = "' . $userEmail . '" and `to` != "' . 'all' . '" GROUP BY subject, `to`) as latest_help'), function ($join) {
                $join->on('helps.id', '=', 'latest_help.id');
            });
        $noticeQuery = Help::where('to', 'all')
            ->select('helps.*')
            ->join(DB::raw('(SELECT MAX(id) as id FROM helps WHERE `to` = "' . 'all' . '" GROUP BY subject) as latest_help'), function ($join) {
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

            $noticeQuery->where(function ($q) use ($search) {
                $q->where('to', 'LIKE', "%{$search}%")
                    ->orWhere('from', 'LIKE', "%{$search}%")
                    ->orWhere('subject', 'LIKE', "%{$search}%")
                    ->orWhere('body', 'LIKE', "%{$search}%");
            });
        }

        $received = $receivedQuery->orderBy('created_at', 'desc')->paginate($limit);
        $sent = $sentQuery->orderBy('created_at', 'desc')->paginate($limit);
        $notice = $noticeQuery->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $received->total();
        $ttlpage = (ceil($ttl / $limit));

        $sent_ttl = $sent->total();
        $sent_ttlpage = (ceil($sent_ttl / $limit));

        $notice_ttl = $sent->total();
        $notice_ttlpage = (ceil($notice_ttl / $limit));

        return view('admin.indexhelp', compact('received', 'sent', 'notice', 'ttl', 'ttlpage', 'sent_ttl', 'sent_ttlpage', 'notice_ttl', 'notice_ttlpage'));
    }

    public function addToSpecial(Request $request)
    {
        $validated = request()->validate([
            'productId' => 'integer|min:1',
            'sub_category_title_id' => 'integer|required|min:1',
            'sub_category_id' => 'integer|required|min:1',
        ]);
        $limit = 10;
        $product = Product::find($request->productId);
        if ($product) {
            $product->special_sub_category_id = $request->sub_category_id;
            $product->save();
        }

        $lists = Product::orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        $subCatTitle = SubCategoryTitle::whereHas('category', function ($query) {
            $query->where('category_name', 'Special Corner');
        })->get();

        return redirect()->route('admin.all.product', compact('lists', 'ttlpage', 'ttl', 'subCatTitle'));
    }

    public function removeFromSpecial($id)
    {
        $limit = 10;
        $product = Product::find($id);
        if ($product) {
            $product->special_sub_category_id = NULL;
            $product->save();
        }

        $lists = Product::orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        $subCatTitle = SubCategoryTitle::whereHas('category', function ($query) {
            $query->where('category_name', 'Special Corner');
        })->get();

        return redirect()->route('admin.all.product', compact('lists', 'ttlpage', 'ttl', 'subCatTitle'));
    }

    // remove coupon from product
    public function removeCoupon(Request $request)
    {
        $product = Product::find($request->id);
        $seller = Seller::where('user_id', $product->seller_id)->first();
        if ($seller->coupon_status == 1) {
            $product->update([
                'coupon_id' => $seller->coupon_id,
                'coupon_status' => 0,
            ]);
        } else {
            $product->update([
                'coupon_id' => null,
                'coupon_status' => 0,
            ]);
        }

        return redirect('/admin/product');
    }

    // remove coupon from shop
    public function removeFromShop($id)
    {
        $seller = Seller::find($id);

        if ($seller) {
            // Update the seller's coupon information
            $seller->coupon_id = null;
            $seller->coupon_status = 0;
            $seller->save();

            // Fetch all products of the seller
            $products = Product::where('seller_id', $seller->user_id)->where('coupon_status', 0)->get();

            // Update coupon information for each product
            foreach ($products as $product) {
                $product->update(['coupon_id' => null]);
            }
        }

        return redirect('/admin/shoplist');
    }


    public function indexspecialsubcategoryproduct($id)
    {
        $limit = 12;
        $validated = request()->validate([
            'page' => 'integer|min:1',
            'sort' => 'integer|min:1',
            'search' => 'string|nullable',
            'categories' => 'array',
            'categories.*' => 'integer|distinct|min:1',
            'price' => 'string|nullable',
            'rating' => 'array',
            'rating.*' => 'integer|distinct|min:1',
            'discount' => 'array',
            'discount.*' => 'integer|distinct|min:1',
        ]);

        $page = $validated['page'] ?? 1;
        $sort = $validated['sort'] ?? 0;
        $search = $validated['search'] ?? null;
        $categories = $validated['categories'] ?? [];
        $price = $validated['price'] ?? null;
        $rating = $validated['rating'] ?? [];
        $discount = $validated['discount'] ?? [];

        $query = Product::query();

        if (!empty($search)) {
            $query->where('product_name', 'like', '%' . $search . '%');
        }

        if (!empty($categories)) {
            $query->whereIn('category_id', $categories);
        }

        if (!empty($price)) {
            $priceRange = explode(';', $price);

            if (count($priceRange) == 2) {
                $minPrice = (float)$priceRange[0];
                $maxPrice = (float)$priceRange[1];

                $query->whereRaw('CAST(selling_price AS DECIMAL) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
            }
        }

        if (!empty($rating)) {
            $averageRated = Review::select(
                'product_id',
                DB::raw('FLOOR(AVG(stars_rated)) AS `average_rating`')
            )
                ->join('products', 'products.id', '=', 'reviews.product_id')
                ->where('products.sub_category_id', $id)
                ->groupBy('product_id')
                ->get();
            $matchedProductIds = [];
            foreach ($averageRated as $rated) {
                if (in_array($rated->average_rating, $rating)) {
                    $matchedProductIds[] = $rated->product_id;
                }
            }
            if (!empty($matchedProductIds)) {
                $query->whereIn('products.id', $matchedProductIds);
            } else {
                $query->where('id', null);
            }
        }

        if (!empty($discount)) {
            if (in_array("1", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) <= 5');
            }
            if (in_array("2", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10');
            }
            if (in_array("3", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15');
            }
            if (in_array("4", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25');
            }
            if (in_array("5", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 25');
            }
        }

        switch ($sort) {
            case 1:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) ASC');
                break;
            case 2:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) DESC');
                break;
            case 3:
                $query->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
                    ->select('products.*', DB::raw('COUNT(reviews.product_id) as review_count'))
                    ->groupBy('products.id')
                    ->orderBy('review_count', 'desc');
                break;
            case 4:
                $query->orderBy('product_name', 'ASC');
                break;
            case 5:
                $query->orderBy('product_name', 'DESC');
                break;
            case 6:
                $query->orderByRaw('CAST(discount_percent AS DECIMAL(10,2)) DESC');
                break;
            default:
                // No sorting applied
                break;
        }

        $shoplist = $query->where('special_sub_category_id', $id)->where('products.status', 1)
            ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $shoplist->total();
        $ttlpage = (ceil($ttl / $limit));

        $reviews = Review::all();

        $categoryWithProductCount = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->select('categories.*', DB::raw('COUNT(products.category_id) as product_count'))
            ->where('products.status', '=', '1')
            ->where('products.special_sub_category_id', $id)
            ->groupBy('categories.id')
            ->get();

        $ratingWithProductCount = Review::select(
            DB::raw('CAST(FLOOR(AVG(stars_rated)) AS UNSIGNED) AS `average_rating`')
        )
            ->join('products', 'products.id', '=', 'reviews.product_id')
            ->where('products.special_sub_category_id', $id)
            ->groupBy('product_id')
            ->get()
            ->groupBy('average_rating')
            ->map(function ($grouped) {
                return $grouped->count();
            });

        $discountWithProductCount = Product::selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) <= 5 THEN 1 END) as group_1_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 5 AND CAST(discount_percent AS DECIMAL) <= 10 THEN 1 END) as group_2_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 10 AND CAST(discount_percent AS DECIMAL) <= 15 THEN 1 END) as group_3_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 15 AND CAST(discount_percent AS DECIMAL) <= 25 THEN 1 END) as group_4_count')
            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 25 THEN 1 END) as group_5_count')
            ->where('special_sub_category_id', $id)
            ->where('status', '=', '1')
            ->first();

        return view('front-end.sub-category-left-sidebar', compact(
            'id',
            'shoplist',
            'ttlpage',
            'ttl',
            'price',
            'search',
            'rating',
            'ratingWithProductCount',
            'discount',
            'discount',
            'discountWithProductCount',
            'sort',
            'reviews',
            'categories',
            'categoryWithProductCount'
        ));
    }

    public function shopTransferDetail($id)
    {
        return view('admin.shoptransfer');
    }

    public function indextransferorderdetail($id)
    {
        $limit = 10;
        $transfer = Transfer::find($id);
        $start_date = Carbon::parse($transfer->start_date)->format('Y/m/d');
        $end_date = Carbon::parse($transfer->end_date)->format('Y/m/d');

        $lists = OrderDetail::with('order')->with('buyer')->with('product')
            ->where('seller_id', $transfer->seller_id)
            ->whereBetween(DB::raw("DATE_FORMAT(created_at, '%Y/%m/%d')"), [$start_date, $end_date])
            ->paginate($limit);
        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.transfer_order_detail', compact('lists', 'ttlpage', 'ttl'));
    }

    public function cashPaymentReceived($id)
    {
        DB::beginTransaction();

        try {
            $order = Order::find($id);

            if (!$order) {
                return redirect()->back()->with('error', 'Order not found.');
            }

            $order->payment_approved = 1;
            $order->created_at = Carbon::now(); // Set created_at to current time
            $order->save();

            $orderDetails = OrderDetail::where('order_id', $id)->get();
            foreach ($orderDetails as $orderDetail) {
                $orderDetail->payment_approved = 1;
                $orderDetail->created_at = Carbon::now();
                $orderDetail->save();
            }

            DB::commit();
            // mail sent to buyer
            $orderedBuyer = Buyer::where('id', $order->buyer_id)->first();
            \Mail::to($orderedBuyer->email)->send(new \App\Mail\BuyerCashOrderSuccess($orderDetails, $orderedBuyer));

            // mail sent to seller
            $sellerIds = $orderDetails->pluck('seller_id')->unique();
            $sellers = User::whereIn('id', $sellerIds)->orWhereIn('created_by', $sellerIds)->get();
            foreach ($sellers as $seller) {
                if ($seller->created_by) {
                    $orderDetails = OrderDetail::with('order')->with('buyer')->with('seller')
                        ->where('buyer_id', $order->buyer_id)->where('order_id', $order->id)
                        ->where('seller_id', $seller->created_by)->get();
                } else {
                    $orderDetails = OrderDetail::with('order')->with('buyer')->with('seller')
                        ->where('buyer_id', $order->buyer_id)->where('order_id', $order->id)
                        ->where('seller_id', $seller->id)->get();
                }
                \Mail::to($seller->email)->send(new \App\Mail\SellerOrderReceived($orderDetails, $seller));
            }

            // mail sent to admin
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                \Mail::to($admin->email)->send(new \App\Mail\AdminOrderReceived($orderDetails, $admin));
            }

            foreach ($sellers as $seller) {
                SellerNotification::create([
                    'seller_id' => $seller->id,
                    'related_id' => $order->id,
                    'message' => 'A new order added:',
                    'time' => Carbon::now(),
                    'seen' => 0,
                ]);
            }

            return redirect()->back()->with('success', 'Payment approved successfully for the order code ' . $order->order_code);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while approving the payment: ' . $e->getMessage());
        }
    }

    function indexbankaccount()
    {
        $limit = 10;
        $bankAccs = BankAccount::paginate($limit);
        $ttl = $bankAccs->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.bank_account', compact('bankAccs', 'ttlpage', 'ttl'));
    }

    function addBankAccount(Request $request)
    {
        $bankAcc = BankAccount::create([
            'bank_name' => $request->bank_name,
            'branch_name' => $request->bank_branch,
            'account_type' => $request->bank_acc_type,
            'account_number' => $request->bank_acc_no,
            'account_name' => $request->bank_acc_name,
        ]);

        return redirect()->route('admin.bank_account');
    }

    function forEditBankAccount($id)
    {
        $bankAcc = BankAccount::find($id);

        return view('admin.edit_bank_account', compact('bankAcc'));
    }

    function editBankAccount(Request $request)
    {
        $bankAcc = BankAccount::find($request->id);
        if ($bankAcc) {
            $bankAcc->bank_name = $request->bank_name;
            $bankAcc->branch_name = $request->bank_branch;
            $bankAcc->account_type = $request->bank_acc_type;
            $bankAcc->account_number = $request->bank_acc_no;
            $bankAcc->account_name = $request->bank_acc_name;
            $bankAcc->save();
        }

        return redirect()->route('admin.bank_account');
    }

    public function deleteBankAccount(Request $request)
    {
        $data = BankAccount::findOrFail($request->id)->delete();
        return redirect()->route('admin.bank_account')->with('success', 'Deleted Successfully.');
    }

    public function markAsSeen($id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->seen = 1;
            $notification->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function allSeen()
    {
        Notification::where('seen', 0)->update(['seen' => 1]);
        return redirect()->back();
    }

    public function indexstory()
    {
        $limit = 10;

        $lists = Story::orderBy('part', 'asc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.story', compact('lists', 'ttlpage', 'ttl'));
    }

    public function ourStory()
    {
        $stories = Story::all();

        return view('front-end.our-story', compact('stories'));
    }

    public function storeStory(Request $request)
    {
        if (!empty($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }

        if (empty($request->id)) {

            $user = Story::create([
                'part' => $request->part,
                'title' => $request->title,
                'title' => $request->title_jp,
                'body' => $request->body,
                'body_jp' => $request->body_jp,
                'image' => $imageName,
            ]);

            return redirect('/admin/story')->with('success', 'Story Added Successfully');
        } else {

            $updval = [
                'part' => $request->part,
                'title' => $request->title,
                'title_jp' => $request->title_jp,
                'body' => $request->body,
                'body_jp' => $request->body_jp,
            ];

            if (!empty($request->image)) {
                $updval['image'] = $imageName;
            }

            Story::where('id', $request->id)->update($updval);
            return redirect('/admin/story')->with('success', 'Story Updated Successfully');
        }
    }

    public function editStory($id)
    {
        $story = Story::find($id);
        $editmode = true;

        return view('admin.addstory', compact('story', 'editmode'));
    }

    public function deleteStory(Request $request)
    {
        $data = Story::where('id', $request->id)->delete();
        return redirect()->back()->with('success', 'Story Deleted Successfully.');
    }
}
