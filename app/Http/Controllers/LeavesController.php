<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\leaveApplication;
use App\Leave;
use App\Admin;
use App\LeaveDay;
use App\LeaveType;

class LeavesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'update', 'status', 'destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves = Leave::all();
        return view('leaves.index')->with('leaves', $leaves);
    }

    public function status($status)
    {
        if ($status == 'pending') {
            $leaves = Leave::where('status', '=', 0)->get();
        }elseif ($status == 'approved') {
            $leaves = Leave::where('status', '=', 1)->get();
        }else {
            $leaves = Leave::where('status', '=', 2)->get();
        }
        
       return view('leaves.status-index')->with(['leaves' => $leaves, 'status' => $status]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leavetypes = LeaveType::select('leave_type')->pluck('leave_type');

        return view('leaves.create')->with('leavetypes', $leavetypes);
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
            'type' => 'required',
            'to_date' => 'required',
            'from_date' => 'required',
            'days_applied' => 'required',
            'description' => 'required',
            'attachments' => 'nullable',
        ]);

        $to = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('to_date'));
        $from = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('from_date'));
        
        if($request->input('type') == 'Maternity') {
            $diff = $to->diffInDays($from) + 1;
        }else {
            $holidays = array(  '2019-01-01', '2019-02-01', '2019-04-19', '2019-04-20', '2019-04-22',
                                '2019-05-01', '2019-05-12', '2019-05-30', '2019-06-16', '2019-07-01',
                                '2019-07-02', '2019-07-15', '2019-07-16', '2019-09-30', '2019-10-1',
                                '2019-12-25', '2019-12-26');

            $diff = $to->diffInWeekdays($from) + 1;
        }
    
        if($request->input('days_applied') != $diff) {
            return back()->with('error', 'correct total days applied for');
        }

        $user_id = auth()->user()->id;

        if ($request->input('type') == 'Sick' or $request->input('type') == 'Maternity') {
            $this->validate($request, [
                'attachments' => 'required',
                'attachments.*' => 'mimes:pdf',
            ]);
        }

        /** Check if user has enough leave days to apply for the leave */
        $leavetype = $request->input('type');
        $leavedays = 0;
       
        $leavetype_id = LeaveType::where('leave_type', $leavetype)->value('id');
        $leavedays = LeaveDay::where('user_id', $user_id)
                            ->where('leavetype_id', $leavetype_id)->value('days');

        if ($leavedays > 0 and $leavedays > $request->input('days_applied')) {
            //create new leave
            $this->create_leave($request, $user_id);
        }else {
            return back()->with('error', 'You do not have enough '.$leavetype.' leave days. Remaining '.$leavedays);
        }

        return redirect('/applications')->with('success', 'Leave Application Submitted');
    }

    public function create_leave(Request $request, $user_id)
    {
        if ($request->hasfile('attachments')) {
            foreach($request->file('attachments') as $file){
                $name = $file->getClientOriginalName();
                $filename = pathinfo($name, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileToUpload = $filename.'_'.time().'.'.$extension;
                $path = $file->storeAs('public/attachments', $fileToUpload);
                $files[] = $fileToUpload;
            }
        }else {
            $files = NULL;
        }

        //Create New Leave Application
        $leave = new Leave;
        $leave->type = $request->input('type');
        $leave->to_date = $request->input('to_date');
        $leave->from_date = $request->input('from_date');
        $leave->days_applied = $request->input('days_applied');
        $leave->attachments = json_encode($files);
        $leave->description = $request->input('description');
        $leave->user_id = $user_id;
        $leave->save();

        $admin = Admin::findOrFail(1);
        $admin->notify(new leaveApplication(auth()->user()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leave = Leave::find($id);

        return view('leaves.show')->with('leave', $leave);
    }

    public function remaining_days($leave)
    {
        $leavetype_id = LeaveType::where('leave_type', $leave->type)->value('id');
        $applied_days = $leave->days_applied;
        $available_days = LeaveDay::where('user_id', $leave->user_id)
                                ->where('leavetype_id', $leavetype_id)->value('days');

        $leaveday_id = LeaveDay::where('user_id', $leave->user_id)
                            ->where('leavetype_id', $leavetype_id)->value('id');

        $remaining = $available_days - $applied_days;
        $leaveday = LeaveDay::find($leaveday_id);
        $leaveday->days = $remaining;
        $leaveday->save();
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
        $leave = Leave::find($id);
        $leave->status = $request->input('status');
        $leave->save();

        if ($request->input('status') == 1) {
            $this->remaining_days($leave);
            return redirect('/leaves')->with('success', 'Leave Approved');
        } else {
            return redirect('/leaves')->with('error', 'Leave Rejected');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leave = Leave::find($id);
        $leave->delete();
        if ($leave->attachments != null) {
            foreach(json_decode($leave->attachments) as $attachment) {
                Storage::delete('public/attachments/'.$attachment);
            }
        }
        return back()->with('success', 'Leave Deleted');
    }
}
