@extends('principal_admin.layout')

@section('sub-contents')
<div class="container col-md-9">
    <div class="row card">
        <div class="card-content">
            <div class="card-title">Add Employee</div>
            <h4 style="padding:10px;padding-left:30px"> Employee Details </h4>
            <form method="POST" action="{{ route('register') }}" style="padding-left:3em">
                {{ csrf_field() }}

                <div class="col-md-5 form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label for="first_name" class="col-md-6 control-label">First Name</label>
                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>
                </div>

                <div class="col-md-5 form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <label for="last_name" class="col-md-6 control-label">Last Name</label>
                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>
                </div>

                <div class="col-md-3 form-group{{ $errors->has('post') ? ' has-error' : '' }}">
                    <label for="post">Post</label>
                    <input id="post" type="text" class="form-control" name="post" value="{{ old('post') }}" required autofocus>
                </div>
                <?php
                    $users = App\User::all();
                    if(count($users) > 0) {   
                        $user = App\User::all()->last();
                        $trim = ltrim($user->staff_id, 'S');
                        $id = (int)$trim + 1;
                        $len = $id !== 0 ? floor(log10($id) + 1) : 1;
                        if ($len == 1) {
                            $staff_id = 'S00'.$id;
                        }elseif ($len == 2) {
                            $staff_id = 'S0'.$id;
                        }else{
                            $staff_id = 'S'.$id;
                        }
                    }else {
                        $staff_id = 'S001';
                    }
                ?>
                <div class="col-md-2 form-group{{ $errors->has('staff_id') ? ' has-error' : '' }}">
                    <label for="staff_id">Staff Id</label>
                    <input id="staff_id" type="text" class="form-control" name="staff_id" value="{{$staff_id}}" readonly>
                </div>

                <div class="col-md-2 form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                    <label for="gender" class="col-md-4 control-label">Gender</label>
                    <select name="gender" id="department" class="form-control">
                            <option value="">Gender</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                    </select>
                </div>

                <div class="col-md-3 form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                    <label for="dob" class="col-md-4 control-label">DOB</label>
                    <input id="dob" type="date" class="form-control" name="dob" value="{{ old('dob') }}" required autofocus>
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
                </div>

                <div class="col-md-2 form-group{{ $errors->has('scale') ? ' has-error' : '' }}">
                    <label for="scale" class="col-md-4 control-label">Scale</label>
                    <select name="scale" id="scale" class="form-control">
                            <option value="">Scale</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>   
                    </select>
                </div>

                <div class="col-md-5 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address" class="col-md-10 control-label">Physical Address</label>
                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>
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
                    <label for="email" class="col-md-6 control-label">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="col-md-5 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
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
