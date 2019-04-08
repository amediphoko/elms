<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\leaveApplication;
use App\Leave;
use App\Admin;

class LeavesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'update', 'status']]);
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
        return view('leaves.create');
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

        $user_id = auth()->user()->id;

        if ($request->input('type') == 'Sick' or $request->input('type') == 'Maternity') {
            $this->validate($request, [
                'attachments' => 'required',
                'attachments.*' => 'mimes:pdf',
            ]);
        }

        if ($request->hasfile('attachments')) {
            foreach($request->file('attachments') as $file){
                $name = $file->getClientOriginalName();
                $filename = pathinfo($name, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileToUpload = $filename.'_'.time().'.'.$extension;
                $path = $file->storeAs('public/attachements', $fileToUpload);
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

        return redirect('/applications')->with('success', 'Leave Application Submitted');
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
        $leave = Leave::find($id);
        $leave->status = $request->input('status');
        $leave->save();

        if ($request->input('status') == 1) {
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
        //
    }
}
