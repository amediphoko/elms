@extends('layouts.app')

@section('content')
<div class="container col-md-9" style="padding:3em; padding-right:0">
    <div class="row" style="padding-left:1em">
        <div class="card stats-card col-md-3" >
            <div style="font-size:2.5em; padding-top:.6em; color:#4e97c7" class="col-md-1 fa fa-users pull-left">
            </div>
            <div style="padding-left:2em" class="col-md-9">   
                <h6 style="font-size: 17px;font-weight: 500;padding-top:.4em">Total Employees</h6>  
                <p style="margin-top:-.5em;font-size: 18px;font-weight: 600;">{{count($users)}}</p>
            </div>
        </div>
        <div class="card stats-card col-md-3 col-sm-offset-1">
            <div style="font-size:2.5em; padding-top:.6em; color:#4e97c7" class="col-md-1 fa fa-building pull-left">
            </div>
            <div style="padding-left:2em" class="col-md-10">   
                <h6 style="font-size: 17px;font-weight: 500;padding-top:.4em">Listed Departments</h6>  
                <p style="margin-top:-.5em;font-size: 18px;font-weight: 600;">{{count($departments)}}</p>
            </div>
        </div>
        <div class="card stats-card col-md-3 col-xs-offset-1">
            <div style="font-size:2.5em; padding-top:.6em; color:#4e97c7" class="col-md-1 fa fa-users pull-left">
            </div>
            <div style="padding-left:2em" class="col-md-10">   
                <h6 style="font-size: 17px;font-weight: 500;padding-top:.4em">Listed Leave Type</h6>  
                <p style="margin-top:-.5em;font-size: 18px;font-weight: 600;">{{count($leaves)}}</p>
            </div>
        </div>
    </div>
    <div class="row card col-md-12" style="postion:relative; top:1em">
        <div class="card-content">
            <div class="card-title">Latest Leave Applications</div>
            <div class="table-responsive">
                <table class="table table-hover" id="dt">
                    <thead>
                        <th>#</th>
                        <th>Staff ID</th>
                        <th>Employee name(s)</th>
                        <th>Department</th>
                        <th>Leave Type</th>
                        <th>Status</th>
                        <th>Reg Date</th>
                        <th>Action</th>
                    </thead>
                    <?php $count = 1; ?>
                    @if (count($leaves) > 0)
                        <tbody>
                            @foreach ($leaves as $leave)
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{$leave->user->staff_id}}</td>
                                    <td>{{$leave->user->first_name}} {{$leave->user->last_name}}</td>
                                    <td>{{$leave->user->department}}</td>
                                    <td>{{$leave->type}}</td>
                                    <td>
                                        @if ($leave->status == 0)
                                            <i class="fa fa-exclamation-circle"></i> Pending approval
                                        @elseif ($leave->status == 1)
                                            <i class="fa fa-circle" style="color:#4ae00ece"></i> Approved
                                        @elseif ($leave->status == 2)
                                            <i class="fa fa-circle" style="color:red"></i> Rejected
                                        @endif
                                    </td>
                                    <td>{{$leave->created_at->toDateString()}}</td>
                                    <td>
                                        <a href="/leaves/{{$leave->id}}">View</a>   
                                    </td>
                                </tr>
                                <?php $count++; ?>
                            @endforeach
                        </tbody>
                    @else
                        <p>There Are No Latest Applications. </a></p>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
