<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;
use App\Leave;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['update_profile']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $departments = Department::all();
        $leaves = Leave::all();
        return view('admin.dashboard')->with(['users' => $users, 'departments' => $departments, 'leaves' => $leaves]);
    }

    public function manage()
    {
        $users = User::all();

        return view('employee.manage')->with('users', $users);
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('employee.edit-profile')->with('user', $user);
    }

    public function update_profile(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'post' => 'required|string|max:191',
            'scale' => 'required|string|max:1',
            'gender' => 'required|string|max:6',
            'dob' => 'required|date',
            'department' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contacts' => 'required',
        ]);
        
        $user = User::find($id);
        //$user->staff_id = $request->input('staff_id');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->post = $request->input('post');
        $user->scale = $request->input('scale');
        $user->gender = $request->input('gender');
        $user->dob = $request->input('dob');
        $user->department = $request->input('department');
        $user->address = $request->input('address');
        $user->contacts = $request->input('contacts');
        //$user->email = $request->input('email');
        $user->save();

        return back()->with('success', 'Employee Info Updated');
    }
}
