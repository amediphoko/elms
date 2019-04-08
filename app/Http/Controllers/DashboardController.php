<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function showApplications()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $count = 1;
        return view('employee.applications')->with(['leaves' => $user->leaves, 'count' => $count]);
    }

    public function showApproved()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $count = 1;
        $leaves = $user->leaves->where('status', '=', 1);
        return view('employee.approved')->with(['leaves' => $leaves, 'count' => $count]);
    }

    public function showRejected()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $count = 1;
        $leaves = $user->leaves->where('status', '=', 2);
        return view('employee.rejected')->with(['leaves' => $leaves, 'count' => $count]);
    }

    public function profile($id)
    {
        $user = User::find($id);
        $leaves = $user->leaves;
        //leave day(s) taken
        $leave_days = $leaves->where('status', '=', 1)->pluck('days_applied');
        $total_days = 0;
        foreach ($leave_days as $days) {
            $total_days += $days;
        }
        return view('employee.profile')->with(['user' => $user, 'leaves' => $leaves, 'total_days'=> $total_days]);
    }

    public function change_pass($id)
    {
        $user = User::find($id);
        return view('employee.change-pass')->with('user', $user);
    }

    public function change_password(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required',
            'newpassword' => 'required|string|min:6',
            'confirmpassword' => 'required',
        ]);
        
        if (Hash::check($request->input('password'), $request->input('oldpassword'))) {
            if ($request->input('newpassword') == $request->input('confirmpassword')) {
                $user = User::find($id);
                $user->password = bcrypt($request->input('newpassword'));
                $user->save();

                return redirect('profile/'.$id)->with('success', 'Password Changed');
            } else {
                return back()->with('error', 'New Password does not match confirm');
            }
        } else {
            return back()->with('error', 'Current Password does not match password');
        }
    }
}
