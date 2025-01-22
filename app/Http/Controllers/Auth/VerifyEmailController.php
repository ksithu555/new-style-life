<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Notification;
use App\Notifications\NewUserRegister;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request , $id , $hash)
    {
        $user = User::where('id',$id)->first();

        if (! hash_equals((string) $id,
                          (string) $user->getKey())) {
            return false;
        }

        if (! hash_equals((string) $hash,
                          sha1($user->getEmailForVerification()))) {
            return false;
        }
        $user->markEmailAsVerified();
        Auth::login($user);

        if ($user->hasVerifiedEmail()) {

            if (Auth::user()->role == 'admin') {
                return redirect()->intended(RouteServiceProvider::ADMIN);

            } else if (Auth::user()->role == 'seller') {
                $admins = User::where('role', 'admin')->get();
                foreach ($admins as $admin) {
                    \Mail::to($admin->email)->send(new \App\Mail\AdminNewMemberRegistration($user, $admin));
                }
                \Mail::to(Auth::user()->email)->send(new \App\Mail\SellerRegistration($user));
                return redirect('/seller');

            } else if (Auth::user()->role == 'buyer') {
                $admins = User::where('role', 'admin')->get();
                foreach ($admins as $admin) {
                    \Mail::to($admin->email)->send(new \App\Mail\AdminNewMemberRegistration($user, $admin));
                }
                \Mail::to(Auth::user()->email)->send(new \App\Mail\BuyerRegistration($user));
                return redirect('/user');

            } else {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
           // return redirect()->intended(RouteServiceProvider::SELLER.'?verified=1');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // Notification case 6
        $admin = User::where('role','admin')->where('noalert', null)->get();
        Notification::send($admin, new NewUserRegister($admin));

        return redirect()->intended(RouteServiceProvider::SELLER.'?verified=1');
    }
}