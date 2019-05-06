<?php

namespace App\Http\Controllers;

use App\User;
use App\LeaveDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrincipalAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:principaladmin', ['except' => ['update_profile']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->take(5);
        return view('principal_admin.dashboard')->with('users', $users);
    }

    public function manage()
    {
        $users = User::all();
        $ids = LeaveDay::select('user_id')->distinct()->get();
        
        return view('principal_admin.manage_staff')->with(['users' => $users, 'ids' => $ids]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('principal_admin.edit-profile')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return redirect('/manage')->with('success', 'Staff Account Info Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if($user->pro_img != 'user-default.png') {
            Storage::delete('public/profile_pictures/'.$user->pro_img);
        }
        $user->delete();
        return back()->with('success', 'Staff Account Deleted.');
    }
}
