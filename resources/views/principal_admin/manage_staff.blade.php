@extends('principal_admin.layout')

@section('sub-contents')
    <div class="col-md-9">
        <div class="row card">
            <div class="card-content">
                <a href="/register" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</a>
                <div class="card-title">Manage Employees</div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        @if (count($users) > 0)
                            <thead>
                                <th>#</th>
                                <th>Staff ID</th>
                                <th>Full Name</th>
                                <th>Department</th>
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
                                        <td>{{$user->created_at->toDateString()}}</td>
                                        <td>
                                            <a href="/users/{{$user->id}}/edit"><i class="fa fa-edit"></i> Edit</a>   
                                            {!!Form::open(['action' => ['PrincipalAdminController@destroy', $user->id], 'method' => 'POST'])!!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                <i style="color:red" class="fa fa-trash">
                                                    {{Form::submit(' Delete', ['style' => 'background-color:transparent; border:none; color:red; font-style:sans-serif', 'onclick' => 'return confirm(\'Are you sure you want to delete?\')'])}}
                                                </i>
                                            {!!Form::close()!!}
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