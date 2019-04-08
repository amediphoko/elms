@extends('layouts.app')

@section('content')
<div class="container col-md-9" style="padding-left:3em; padding-top:1em">
    <div class="row card">
        <div class="card-content">
            <div class="card-title">Update Employee</div>

            {!! Form::open(['action' => ['AdminController@update_profile', $user->id], 'method' => 'POST']) !!}
                {{ csrf_field() }}

                <div class="col-md-4 form-group{{ $errors->has('staff_id') ? ' has-error' : '' }}">
                    <label for="staff_id">Staff Id </label>
                    <input id="staff_id" type="number" class="form-control" name="staff_id" value="{{$user->staff_id}}" readonly>
                </div>

                <div class="col-md-6 form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label for="first_name" class="col-md-4 control-label">First Name</label>
                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{$user->first_name}}" required autofocus>
                </div>

                <div class="col-md-5 form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <label for="last_name" class="col-md-6 control-label">Last Name</label>
                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{$user->last_name}}" required autofocus>
                </div>

                <div class="col-md-2 form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                    <label for="gender" class="col-md-4 control-label">Gender</label>
                    <select name="gender" id="department" class="form-control">
                            <option value="{{$user->gender}}">{{$user->gender}}</option>
                            @if ($user->gender == "Male")
                                <option value="Female">Female</option>
                            @else
                                <option value="Male">Male</option>
                            @endif
                    </select>
                </div>

                <div class="col-md-3 form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                    <label for="dob" class="col-md-4 control-label">DOB</label>
                    <input id="dob" type="date" class="form-control" name="dob" value="{{$user->dob}}" required autofocus>
                </div>

                <div class="col-md-3 form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                    <label for="department" class="col-md-4 control-label">Department</label>
                    <select name="department" id="department" value="{{$user->department}}" class="form-control">
                            <option value="{{$user->department}}">{{$user->department}}</option>
                            <?php
                                $departments = App\Department::all();
                            ?>
                            @if (count($departments) > 0)
                                @foreach ($departments as $department)
                                    @if ($department->name != $user->department)
                                        <option value="{{$department->name}}">{{$department->name}}</option>
                                    @endif
                                @endforeach
                            @endif
                    </select>
                </div>

                <div class="col-md-6 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address" class="col-md-4 control-label">Address</label>
                    <input id="address" type="text" class="form-control" name="address" value="{{$user->address}}" required autofocus>
                </div>

                <div class="col-md-5 form-group"{{ $errors->has('contacts') ? ' has-error' : '' }}>
                    <label for="contacts" class="col-md-4 control-label">Contacts</label>
                    <input id="contacts" type="number" class="form-control" name="contacts" value="{{$user->contacts}}" required autofocus>
                </div>

                <div class="col-md-5 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-5 control-label">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" readonly>
                </div>

                <div class="col-md-6 col-md-offset-4 form-group">
                    {{Form::hidden('_method', 'PUT')}}
                    <button type="submit" class="btn btn-primary">
                        Update 
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div> 
@endsection
