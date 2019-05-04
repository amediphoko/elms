<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveType;

class LeaveTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leavetype = LeaveType::all();

        return view('leavetype.index')->with('leavetype', $leavetype);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leavetype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'leavetype' => 'required',
            'description' => 'required',
            'lower' => 'required',
            'upper' => 'required'
        ]);

        $leavetype = new LeaveType;
        $leavetype->leave_type = $request->input('leavetype');
        $leavetype->description = $request->input('description');
        $leavetype->lower = $request->input('lower');
        $leavetype->upper = $request->input('upper');
        $leavetype->save();

        return redirect('/leavetype')->with('success', 'Leave type created');
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
        $leavetype = LeaveType::find($id);

        return view('leavetype.edit')->with('leavetype', $leavetype);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'leavetype' => 'required',
            'description' => 'required',
            'lower' => 'required',
            'upper' => 'required'
        ]);

        $leavetype = LeaveType::find($id);
        $leavetype->leave_type = $request->input('leavetype');
        $leavetype->description = $request->input('description');
        $leavetype->lower = $request->input('lower');
        $leavetype->upper = $request->input('upper');
        $leavetype->save();

        return redirect('/leavetype')->with('success', 'Leave Type Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leavetype = LeaveType::find($id);
        $leavetype->delete();

        return redirect('/leavetype')->with('success', 'Leave Type deleted');
    }
}
