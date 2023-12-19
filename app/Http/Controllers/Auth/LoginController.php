<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\usersRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $guard = 'Admin';
    public function getLogin() {
        return view('auth.login');
    }
    public function postLogin(usersRequest $request) {
       $validation = Auth::guard('Admin')->attempt([
        'email'    => $request->get('email'),
        'password' => $request->get('password'),
       ]);

       if($validation) {
        return redirect('admin-backend/index');
       } else {
        return redirect()->back()->withErrors(['loginErrors' => 'Wrong Email or Password'])->withInput();
       }
    }

    public function getLogout() {
        Auth::logout();
        Session::flush();
        return redirect('admin-backend/login');
    }
}
