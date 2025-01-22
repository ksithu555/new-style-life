<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Validator;
use DateTime;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{

    public function validateuser($request, $editpassword = true , $editmode = false, $emailuniquecheck = true)
    {

        $check = [
            'name' => 'required|string|max:255',

            'gender' => 'not_in:0',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|confirmed|min:6',
            'check' => 'required',
            'dob' => 'required',
            // 'phone' => ['required', 'regex:/^(0([1-9]{1}-?[1-9]\d{3}|[1-9]{2}-?\d{3}|[1-9]{2}\d{1}-?\d{2}|[1-9]{2}\d{2}-?\d{1})-?\d{4}|0[789]0-?\d{4}-?\d{4}|050-?\d{4}-?\d{4})$/'],
            'phone' => 'required|numeric',

        ];

        if ($request->role == 'hcompany') {
            $check['furiname'] = 'required|string|max:255';
        }


        if (!$editpassword) {
            unset($check['password']);
        }

        if ($editmode) {
            unset($check['check']);
        }

        if ($emailuniquecheck) {
            $check['email'] .= '|unique:users' ;
        }

        // print_r("$request->check");die;
        $validator = Validator::make($request->all(), $check,
        [
            'furiname.required' => '法人名を入力してください',
            // 'phone.regex' => '有効な電話番号を入力してください',
            'check.required' => __('validation.pleasecheck'),
        ]);

        return $validator;

    }

}
