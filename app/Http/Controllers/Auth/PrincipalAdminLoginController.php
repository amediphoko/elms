<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PrincipalAdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:principaladmin', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('auth.principaladmin-login');
    }

    public function login(Request $request)
    {
        $errors = ['email' => trans('auth.failed')];
        //validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        //attempt to log the user in
        if(Auth::guard('principaladmin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            //if successful, redirect to their intended location
            return redirect()->intended(route('principaladmin.dashboard'));
        }
        //if unsuccessful, redirect them back to the login with form data
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors($errors);
    }

    public function logout()
    {
        Auth::guard('principaladmin')->logout();
        return redirect('principaladmin.login');
    }
}
