<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = Auth::user();

        if (!empty($user->role)) {
            if ($user->role == 'admin') {
                return redirect()->intended(RouteServiceProvider::ADMIN);
            } else if ($user->role == 'seller' && $user->status == 1) {
                return redirect()->intended(RouteServiceProvider::SELLER);
            } else if ($user->role == 'buyer' && $user->status == 1) {
                return redirect('/user');
            } else {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }

        return view('auth.login');
    }



    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $loginUser = User::where('email', $request->email)->first();
        if(!$loginUser)
        {
            return back()->with('error', 'Incorrect!')->with('incorrect', 'Email or password is incorrect!');
        }
        if (!Hash::check($request->password, $loginUser->password)) {
            return back()->with('error', 'Incorrect!')->with('incorrect', 'Email or password is incorrect!');
        }

        if($loginUser->email_verified_at == null)
        {
            $user = $loginUser;
            if ($loginUser->role == 'seller')
            return view('auth.seller-verify-email', compact('user'));

            if ($loginUser->role == 'buyer')
            return view('auth.buyer-verify-email', compact('user'));
            // return redirect()->back()->with('error', 'Please verify email first!');
        }

        if($loginUser->role == 'admin')
        {
            if($loginUser->status == 1)
            {
                $request->authenticate();
                $request->session()->regenerate();
                return redirect('/admin');
            }
            else
            {
                return redirect()->back()->with('error', 'Your account have been inactivated!');
            }
        }

        if($loginUser->role == 'seller')
        {
            if($loginUser->status == 1)
            {
                $request->authenticate();
                $request->session()->regenerate();
                return redirect()->intended(RouteServiceProvider::SELLER);
            }
            else
            {
                return redirect()->back()->with('error', 'Your account have been inactivated!');
            }
        }

        if($loginUser->role == 'buyer')
        {
            if($loginUser->status == 1)
            {
                $request->authenticate();
                $request->session()->regenerate();
                $intendedUrlWithDomain = $request->session()->pull('url.intended');
                $intendedUrlComponents = parse_url($intendedUrlWithDomain);
                $intendedPath = $intendedUrlComponents['path'];
                $queryString = isset($intendedUrlComponents['query']) ? '?' . $intendedUrlComponents['query'] : '';
                $intendedUrl = $intendedPath . $queryString;
    
                if ($intendedUrl)
                return redirect($intendedUrl);
    
                else
                return redirect('/user');
            }
            else
            {
                return redirect()->back()->with('error', 'Your account have been inactivated!');
            }
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}