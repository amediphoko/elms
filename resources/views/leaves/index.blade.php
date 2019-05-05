@extends('layouts.app')

@section('content')
    <div class="container col-md-9" style="padding-left:3em; padding-top:1em">
        <div class="row card">
            <div class="card-content">
                <div class="card-title">Leave History</div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        @if (count($leaves) > 0)
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="200">Employee Name</th>
                                    <th width="120">Leave Type</th>

                                        <th width="180">Posting Date</th>                 
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php $count = 1; ?>
                            <tbody>
                                @foreach ($leaves as $leave)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$leave->user->first_name}} {{$leave->user->last_name}}</td>
                                        <td>{{$leave->type}}</td>
                                        <td>{{$leave->created_at->toDateString()}}</td>
                                        <td>
                                            @if ($leave->status == 0)
                                                <i class="fa fa-exclamation-circle"></i> Pending approval
                                            @elseif ($leave->status == 1)
                                                <i class="fa fa-circle" style="color:#4ae00ece"></i> Approved
                                            @elseif ($leave->status == 2)
                                                <i class="fa fa-circle" style="color:red"></i> Rejected
                                            @endif
                                        </td>
                                        @if ($leave->status == 2)
                                            <td>
                                                {!!Form::open(['action' => ['LeavesController@destroy', $leave->id], 'method' => 'POST'])!!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    <i style="color:red" class="fa fa-trash">
                                                        {{Form::submit(' Delete', ['style' => 'background-color:transparent; border:none; color:red; font-style:sans-serif', 'onclick' => 'return confirm(\'Are you sure you want to delete?\')'])}}
                                                    </i>
                                                {!!Form::close()!!}
                                            </td>
                                        @else
                                            <td><a href="/leaves/{{$leave->id}}">View Details</a></td>
                                        @endif
                                    </tr>
                                    <?php $count++; ?>
                                @endforeach
                            </tbody>
                        @else
                            <p>There Are No Leave Applications.</a></p>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection