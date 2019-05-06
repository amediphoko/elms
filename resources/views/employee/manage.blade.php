@extends('layouts.app')

@section('content')
    <div class="container col-md-9" style="padding-left:3em; padding-top:1em">
        <div class="row card">
            <div class="card-content">
                <div class="card-title">Manage Employees</div>
                <div class="table-responsive">
                    <table class="table table-hover" id="dt">
                        @if (count($users) > 0)
                            <thead>
                                <th>#</th>
                                <th>Staff ID</th>
                                <th>Full Name</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Reg Date</th>
                                <th>Action</th>
                                <th>Days</th>
                            </thead>
                            <?php $count = 1; ?>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$user->staff_id}}</td>
                                        <td>{{$user->first_name}} {{$user->last_name}}</td>
                                        <td>{{$user->department}}</td>
                                        <td>
                                            <i class="fa fa-circle" style="color:#4ae00ece"></i> active
                                        </td>
                                        <td>{{$user->created_at->toDateString()}}</td>
                                        <td>
                                            <a href="/users/{{$user->id}}/edit"><i class="fa fa-edit"></i> Edit</a>   
                                        </td>
                                        <td>
                                            @if (count($ids->where('user_id', $user->id)) == 0)
                                                @include('inc.adddays')
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $count++; ?>
                                @endforeach
                            </tbody>
                        @else
                            <p>There Are No Employees. Add an Employee <a href="{{ url('/register') }}">here.</a></p>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection