@extends('layouts.app')

@section('content')
    <div class="container col-md-9" style="padding-left:3em; padding-top:1em">
        <div class="row card">
            <div class="card-content">
                <div class="card-title">{{$status}} Leaves</div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        @if (count($leaves) > 0)
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="200">Employe Name</th>
                                    <th width="120">Leave Type</th>

                                    <th width="180">Posting Date</th>                 
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php $count = 1;?>
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
                                        <td><a href="/leaves/{{$leave->id}}">View Details</a></td>
                                    </tr>
                                    <?php $count++; ?>
                                @endforeach
                            </tbody>
                        @else
                            <p>There Are No {{$status}} Leave Applications.</a></p>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection