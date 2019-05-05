@extends('layouts.app')

@section('content')
    <div class="container col-md-9" style="padding-left:3em; padding-top:1em">
        <div class="row card">
            <div class="card-content">
                <div class="card-title">My Profile</div>
                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#userinfo" id="userinfo-tab" role="tab" datatoggle="tab" aria-controls="userinfo" aria-expanded="true">
                            <span class="fa fa-info-circle"></span> User Info Summary</a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#edit" role="tab" id="edit-tab" data-toggle="tab" aria-controls="edit" aria-expanded="false">
                            Edit Information</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="userinfo" aria-labelledby="userinfo-tab">
                        <div class="col-md-4">
                            <div class="profile-image" style="padding-left:40px">
                                @if ($user->pro_img == 'user-default.png')
                                    <img src="{{asset('img/user-default.png')}}" id="output" class="output">
                                @else
                                    <img src="/storage/profile_pictures/{{$user->pro_img}}" id="output">
                                @endif
                                
                                {!! Form::open(['action' => ['DashboardController@img_update', Auth::user()->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}
                                    <input type="file" name="pro_img" id="pro_img"><br>
                                    <label for="pro_img" style="cursor:pointer;margin-left:10px">
                                        <i style="font-size:1.2em" class="fa fa-camera"></i> Change Image
                                    </label>
                                    {{Form::hidden('_method', 'PUT')}}
                                    <button type="submit" class="btn btn-success pull-right">
                                        <i class="fa fa-save"></i>
                                    </button>
                                {!! Form::close() !!}
                            </div>
                            <br>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Leave Summary</h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            Total Leave Applications <span class="badge">{{count($leaves)}}</span>
                                        </li>
                                        <li class="list-group-item">
                                            Pending Applications <span class="badge">{{count($leaves->where('status', '=', 0))}}</span>
                                        </li>
                                        <li class="list-group-item">
                                            Approved Applications <span class="badge">{{count($leaves->where('status', '=', 1))}}</span>
                                        </li>
                                        <li class="list-group-item">
                                            Rejected Applications <span class="badge">{{count($leaves->where('status', '=', 2))}}</span>
                                        </li>
                                        <li class="list-group-item">
                                            Total Day(s) used/year <span class="badge">{{$total_days}}</span>
                                        </li>
                                        <li class="list-group-item">
                                            Day(s) remaining/year <span class="badge">{{$remaining}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-md-offset-1" style="margin-top:40px">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Employee Details</h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <i class=" fa fa-user"></i> <b>Name(s) :</b> {{$user->first_name}} {{$user->last_name}}
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa fa-id-badge"></i> <b>Staff ID :</b> {{$user->staff_id}}
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa fa-id-badge"></i> <b>Post :</b> {{$user->post}}
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa fa-id-badge"></i> <b>Scale :</b> {{$user->scale}}
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa fa-at"></i> <b>Email :</b> {{$user->email}}
                                        </li>
                                        <li class="list-group-item">
                                            @if ($user->gender == 'Male')
                                                <i class="fa fa-male"></i> <b>Gender :</b> {{$user->gender}}
                                            @elseif ($user->gender == 'Female')
                                                <i class="fa fa-female"></i> <b>Gender :</b> {{$user->gender}}
                                            @endif
                                        </li>
                                        <li class="list-group-item">
                                            <i class=" fa fa-calendar"></i> <b>DOB :</b> {{$user->dob}}
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa fa-building"></i> <b>Department :</b> {{$user->department}}
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa fa-address-card-o"></i> <b>Physical Address :</b> {{$user->address}}
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fa fa-phone"></i> <b>Contacts :</b> (+267) {{$user->contacts}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="edit" aria-labelledby="edit-tab">
                        @include('inc.update-user');
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
        