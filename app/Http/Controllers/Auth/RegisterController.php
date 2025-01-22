<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Seller;
use App\Models\Country;
use App\Models\Prefecture;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function SellerRegister()
    {
        $country = Country::get();
        return view('auth.seller_register',compact('country'));
    }

    public function SellerRegistered(Request $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return back()->withErrors(['email' => 'Email already exists.'])->withInput();
        }
        $img = $request->file('shop_logo');
        $filename = time() . '.' . $img->getClientOriginalExtension();
        $img->move(public_path('images'), $filename);

        $user = User::create([
            'name' => $request->user_name,
            'email' => $request->email,
            'role' => 'seller',
            'password' => Hash::make($request->password),
            'status' => 1,
        ]);
        event(new Registered($user));

        $seller = Seller::create([
            'user_id' => $user->id,
            'country_id' =>$request->country,
            'bank_name' => $request->bank_name,
            'bank_branch' =>$request->bank_branch,
            'bank_acc_type' => $request->bank_acc_type,
            'bank_acc_no' => $request->bank_acc_no,
            'bank_acc_name' => $request->bank_acc_name,
            'shop_name' => $request->shop_name,
            'shop_logo' => $filename,
            'shop_establish' => $request->shop_establish,
            'phone' => $request->phone,
            'zip_code' => $request->zip_code,
            'prefecture' => $request->prefecture,
            'city' => $request->city,
            'chome' => $request->chome,
            'building' => $request->building,
            'room' => $request->room,
            'url' => $request->url,
            'commission' => 0,
            'status' => 0
        ]);

        event(new Registered($seller));

        Notification::create([
            'related_id' => $seller->id,
            'message' => 'A new store added:',
            'time' => Carbon::now(),
            'seen' => 0,
        ]);

        return view('auth.seller-verify-email',compact('user'));
    }
}