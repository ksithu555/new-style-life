<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

use App\Models\User;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (!empty($request->user())) {
            if ($request->user()->hasVerifiedEmail()) {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
            $request->user()->sendEmailVerificationNotification();
        } else {

            $user = User::where('email',$request->email)->first();
            $user->sendEmailVerificationNotification();

            if ($user->role == "buyer")
            return view('auth.buyer-verify-email', compact('user'));

            if ($user->role == "seller")
            return view('auth.seller-verify-email', compact('user'));
        }

        // print_r($request->user());
        // echo "<br>";
        // echo "<br>";
        // print_r($user);
        // echo "<br>";
        // echo "<br>";
        // print_r($request->email);
        // die;
        $email = $request->email;
        $msg = __('auth.doneresend');

        return view('auth.verify-email',compact('email','msg'));
        // return back()->with('status', 'verification-link-sent');
    }
}