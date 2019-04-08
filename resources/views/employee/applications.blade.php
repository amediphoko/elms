@extends('layouts.app')

@section('content')
    <div class="container col-md-9" style="padding-left:3em; padding-top:1em">
        <div class="row card">
            <div class="card-content">
                <div class="card-title">My Leave History</div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        @if (count($leaves) > 0)
                            <thead>
                                <th>#</th>
                                <th width="120">Leave Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Description</th>
                                <th>Sent at</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @foreach ($leaves as $leave)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$leave->type}}</td>
                                        <td>{{$leave->from_date}}</td>
                                        <td>{{$leave->to_date}}</td>
                                        <td>{{ strip_tags($leave->description) }}</td>
                                        <td>{{$leave->created_at}}</td>
                                        <td>
                                            @if ($leave->status == 0)
                                                <i class="fa fa-exclamation-circle"></i> Pending approval
                                            @elseif ($leave->status == 1)
                                                <i class="fa fa-circle" style="color:#4ae00ece"></i> Approved
                                            @elseif ($leave->status == 2)
                                                <i class="fa fa-circle" style="color:red"></i> Rejected
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $count++; ?>
                                @endforeach
                            </tbody>
                        @else
                            <p>Leave Application History Empty.</p>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection