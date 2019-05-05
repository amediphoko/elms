<?php

namespace App\Http\Controllers;

use App\LeaveType;
use App\LeaveDay;
use Illuminate\Http\Request;

class LeaveDaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $leavetypes = LeaveType::select('leave_type')->pluck('leave_type');

        //return $request->input('sick');

        if (count($leavetypes) > 0) {
            foreach ($leavetypes as $leavetype) {
                $this->validate($request, [
                    $leavetype => 'required|integer',
                ]);
            }
        }
        
        if (count($leavetypes) > 0) {
            foreach ($leavetypes as $leavetype) {
                $leavetype_id = LeaveType::where('leave_type',  $leavetype)->value('id');
                $leaveday = new LeaveDay;
                $leaveday->user_id = $request->input('user_id');
                $leaveday->leavetype_id = $leavetype_id;
                $leaveday->days = $request->input($leavetype);
                $leaveday->save();
            }
        }

        return back()->with('success', 'Days Added.');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
