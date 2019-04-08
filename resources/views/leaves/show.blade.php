@extends('layouts.app')

@section('content')
    <div class="container col-md-9" style="padding-left:3em; padding-top:1em">
        <div class="row card">
            <div class="card-content">
                <div class="card-title">Leave Details</div>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td style="font-size:16px;"> <b>Employee Name :</b></td>
                                <td><a href="" target="_blank">
                                {{$leave->user->first_name." ".$leave->user->last_name}}</a></td>
                                <td style="font-size:16px;"><b>Staff ID :</b></td>
                                <td>{{$leave->user->staff_id}}</td>
                                <td style="font-size:16px;"><b>Gender :</b></td>
                                <td>{{$leave->user->gender}}</td>
                            </tr>

                            <tr>
                                <td style="font-size:16px;"><b>Email:</b></td>
                                <td>{{$leave->user->email}}</td>
                                <td style="font-size:16px;"><b>Contact No. :</b></td>
                                <td>(+267) {{$leave->user->contacts}}</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                            <tr>
                                <td style="font-size:16px;"><b>Leave Type :</b></td>
                                <td>{{$leave->type}}</td>
                                <td style="font-size:16px;"><b>Leave Date :</b></td>
                                <td>from {{$leave->from_date}} to {{$leave->to_date}} <b>({{$leave->days_applied}}days)</b></td>
                                <td style="font-size:16px;"><b>Requested at :</b></td>
                                <td>{{$leave->created_at->toDateString()}}</td>
                            </tr>

                            <tr>
                                <td style="font-size:16px;"><b>Leave Status :</b></td>
                                <td colspan="5">
                                    @if ($leave->status == 0)
                                        <i class="fa fa-exclamation-circle"></i> Pending approval
                                    @elseif ($leave->status == 1)
                                        <i class="fa fa-circle" style="color:#4ae00ece"></i> Approved
                                    @elseif ($leave->status == 2)
                                        <i class="fa fa-circle" style="color:red"></i> Rejected
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td colspan="5">
                                    <button class="btn btn-primary" data-toggle="modal" href="#myModal">
                                        <i class="fa fa-pencil-square-o"></i> review leave
                                    </button>
                                    {!! Form::open(['action' => ['LeavesController@update', $leave->id], 'method' => 'POST']) !!}
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">
                                                        <span aria-hidden="true">&times;</span>
                                                        <span class="sr-only">Close</span>
                                                        </button>
                                                        <h4 class="modal-title" id="myModalLabel">Respond To Application</h4>
                                                    </div>
                                                    <!-- Body -->
                                                    <div class="modal-body">
                                                        <select class="form-control" name="status" required="">
                                                            <option value="">Choose your option</option>
                                                            <option value="1">Approved</option>
                                                            <option value="2">Not Approved</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        {{Form::hidden('_method', 'PUT')}}
                                                        <input type="submit" class="btn btn-primary">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{Form::close()}}                  
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection