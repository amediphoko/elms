@extends('principal_admin.layout')

@section('sub-contents')
    <!-- Latest Users -->
    <div class="panel panel-default col-md-9">
        <div class="panel-heading">
            <h3 class="panel-title">Latest Staff Accounts</h3>
        </div>
        @if (count($users) > 0)
            <div class="panel-body" style="font-weight:100">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Staff Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created</th>
                    </tr>
                    @foreach ($users as $user)
                        <tr>        
                            <td>{{$user->staff_id}}</td>
                            <td>{{$user->first_name}} {{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at->toDateString()}}</td>     
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif
    </div>
@endsection