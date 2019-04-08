@extends('layouts.app')

@section('content')
<div class="container col-md-9" style="padding-left:3em; padding-top:1em">
    <div class="row card">
        <div class="card-content">
            <div class="card-title">Change Password</div>

            {!! Form::open(['action' => ['DashboardController@change_password', $user->id], 'method' => 'POST']) !!}
                {{ csrf_field() }}
                
                <input type="text" name="oldpassword" value="{{$user->password}}" hidden>

                <div class="col-md-4 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-7 control-label">Current Password</label>
                    <input id="password" type="password" class="form-control" name="password" required autofocus>
                </div>

                <div class="col-md-4 form-group"{{ $errors->has('newpassword') ? ' has-error' : '' }}>
                    <label for="newpassword" class="col-md-6 control-label">New Password</label>
                    <input id="newpassword" type="password" class="form-control" name="newpassword" required autofocus>
                </div>

                <div class="col-md-4 form-group{{ $errors->has('confirmpassword') ? ' has-error' : '' }}">
                    <label for="confirmpassword" class="col-md-7 control-label">Confirm Password</label>
                    <input id="confirmpassword" type="password" class="form-control" name="confirmpassword" required autofocus>
                </div>

                <div class="col-md-6 form-group">
                    {{Form::hidden('_method', 'PUT')}}
                    <button type="submit" class="btn btn-primary">
                        Change Password
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div> 
@endsection
