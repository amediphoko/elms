@extends('layouts.app')

@section('content')
<div class="container col-md-9" style="padding-left:3em; padding-top:1em">
    <div class="row card">
        <div class="card-content">
            <div class="card-title">Add Employee</div>

            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="col-md-4 form-group{{ $errors->has('staff_id') ? ' has-error' : '' }}">
                    <label for="staff_id">Staff Id</label>
                    <input id="staff_id" type="number" class="form-control" name="staff_id" value="{{ old('staff_id') }}" required autofocus>

                    @if ($errors->has('staff_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('staff_id') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-6 form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label for="first_name" class="col-md-4 control-label">First Name</label>
                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                    @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-5 form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <label for="last_name" class="col-md-6 control-label">Last Name</label>
                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                    @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-2 form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                    <label for="gender" class="col-md-4 control-label">Gender</label>
                    <select name="gender" id="department" class="form-control">
                            <option value="">Gender</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                    </select>

                    @if ($errors->has('gender'))
                        <span class="help-block">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-3 form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                    <label for="dob" class="col-md-4 control-label">DOB</label>
                    <input id="dob" type="date" class="form-control" name="dob" value="{{ old('dob') }}" required autofocus>

                    @if ($errors->has('dob'))
                        <span class="help-block">
                            <strong>{{ $errors->first('dob') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-3 form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                    <label for="department" class="col-md-4 control-label">Department</label>
                    <select name="department" id="department" class="form-control">
                            <option value="">Department...</option>
                            <?php
                                $departments = App\Department::all();
                            ?>
                            @if (count($departments) > 0)
                                @foreach ($departments as $department)
                                    <option value="{{$department->name}}">{{$department->name}}</option>
                                @endforeach
                            @endif
                    </select>

                    @if ($errors->has('department'))
                        <span class="help-block">
                            <strong>{{ $errors->first('department') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-6 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address" class="col-md-4 control-label">Address</label>
                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-5 form-group{{ $errors->has('contacts') ? ' has-error' : '' }}">
                    <label for="contacts" class="col-md-4 control-label">Contacts</label>
                    <input id="contacts" type="number" class="form-control" name="contacts" value="{{ old('contacts') }}" required autofocus>

                    @if ($errors->has('contacts'))
                        <span class="help-block">
                            <strong>{{ $errors->first('contacts') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-5 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-5 control-label">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-5 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-5 form-group">
                    <label for="password-confirm" class="col-md-6 control-label">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="col-md-6 col-md-offset-4 form-group">
                    <button type="submit" class="btn btn-primary">
                        Add Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 
@endsection
