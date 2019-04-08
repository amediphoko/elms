<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PagesController extends Controller
{
    public function index() {

        if (Auth::guard('web')->check()) {
            return redirect('/dashboard');
        } elseif (Auth::guard('admin')->check()) {
            return redirect('admin/dashboard');
        }
        
        return view('pages.index');
        
    }
}
