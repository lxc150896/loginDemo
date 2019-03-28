<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
    	return view('user.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $arrEmailPass = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if ($request->remember == 'no') {
            $remember = false;
        } else {
            $remember = true;
        }
        if (Auth::attempt($arrEmailPass, $remember)) {

            return redirect()->intended('admin/home');
        } else {
            return back()->withInput()->with('error', 'khoong hop le!');
        }
    }
}
