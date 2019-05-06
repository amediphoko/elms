<div class="bg-dark" id="sidebar">
    @if(Auth::guard('web')->check() or Auth::guard('admin')->check())
        <div class="sidebar-profile">
            <div class="sidebar-profile-image">
                @if (Auth::guard('web')->check())
                    @if (Auth::user()->pro_img == 'user-default.png')
                        <img src="{{asset('img/user-default.png')}}" class="img-circle" width="100em" height="100em">
                    @else
                        <img src="/storage/profile_pictures/{{Auth::user()->pro_img}}" class="img-circle" width="100em" height="100em">
                    @endif
                @endif
            </div>
            <div class="sidebar-profile-info" style="text-align:center">
                @if (Auth::guard('web')->check())
                    <p>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
                    <span>Staff Id: {{Auth::user()->staff_id}}</span>
                @else
                    <h4 style="font-weight:600">Administrator</h4>
                    <p style="font-weight:600">{{Auth::guard('admin')->user()->name}}</p>
                @endif  
            </div>
        </div>
        <ul id="accordion1" class="nav flex-column">
            @if(Auth::guard('web')->check())
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">
                        <span class="glyphicon glyphicon-dashboard"></span> Dashboard 
                        <span class="glyphicon glyphicon-triangle-left active-span"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/profile/{{Auth::user()->id}}">
                        <span class="glyphicon glyphicon-user"></span> My Profile
                        <span class="glyphicon glyphicon-triangle-left active-span"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/change_pass/{{Auth::user()->id}}">
                        <span class="glyphicon glyphicon-cog"></span> Change Password
                        <span class="glyphicon glyphicon-triangle-left active-span"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#item-1" data-parent="#accordion1">
                        <span class="glyphicon glyphicon-tasks"></span> Leaves</a>
                    <div id="item-1" class="collapse">
                        <ul class="nav flex-column ml-3">
                            <li class="nav-item">
                                <a class="nav-link" href="/leaves/create">
                                    <span class="glyphicon glyphicon-edit"></span> Apply Leave
                                    <span class="glyphicon glyphicon-triangle-left active-span"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/applications">
                                    <span class="fa fa-history"></span> Leave History
                                    <span class="glyphicon glyphicon-triangle-left active-span"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/approved">
                                    <span class="glyphicon glyphicon-ok-circle"></span> Approved Leaves
                                    <span class="glyphicon glyphicon-triangle-left active-span"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/rejected">
                                    <span class="glyphicon glyphicon-ban-circle"></span> Rejected Leaves
                                    <span class="glyphicon glyphicon-triangle-left active-span"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/admin">
                        <span class="glyphicon glyphicon-dashboard"></span> Dashboard
                        <span class="glyphicon glyphicon-triangle-left active-span"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#item-2" data-parent="#accordion1">
                        <span class="fa fa-building-o"></span> Department</a>
                    <div id="item-2" class="collapse">
                    <ul class="nav flex-column ml-3">
                        <li class="nav-item">
                            <a class="nav-link" href="/departments/create">
                                <span class="glyphicon glyphicon-plus"></span> Add Department
                                <span class="glyphicon glyphicon-triangle-left active-span"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/departments">
                                <span class="fa fa-cogs"></span> Manage Department
                                <span class="glyphicon glyphicon-triangle-left active-span"></span>
                            </a>
                        </li>
                    </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#item-3" data-parent="#accordion1">
                        <span class="fa fa-angle-left"></span> <span class="fa fa-angle-right"></span> Leave Type</a>
                    <div id="item-3" class="collapse">
                    <ul class="nav flex-column ml-3">
                        <li class="nav-item">
                            <a class="nav-link" href="/leavetype/create">
                                <span class="glyphicon glyphicon-plus"></span> Add Leave Type
                                <span class="glyphicon glyphicon-triangle-left active-span"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/leavetype">
                                <span class="fa fa-cogs"></span> Manage Leave Type
                                <span class="glyphicon glyphicon-triangle-left active-span"></span>
                            </a>
                        </li>
                    </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#item-5" data-parent="#accordion1">
                        <span class="fa fa-desktop"></span> Leave Management</a>
                    <div id="item-5" class="collapse">
                    <ul class="nav flex-column ml-3">
                        <li class="nav-item">
                            <a class="nav-link" href="/leaves">
                                <span class="glyphicon glyphicon-list"></span> All Leaves
                                <span class="glyphicon glyphicon-triangle-left active-span"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/leave/pending">
                                <span class="glyphicon glyphicon-exclamation-sign"></span> Pending Leaves
                                <span class="glyphicon glyphicon-triangle-left active-span"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/leave/approved">
                                <span class="glyphicon glyphicon-ok-circle"></span> Approved Leaves
                                <span class="glyphicon glyphicon-triangle-left active-span"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/leave/rejected">
                                <span class="glyphicon glyphicon-ban-circle"></span> Rejected Leaves
                                <span class="glyphicon glyphicon-triangle-left active-span"></span>
                            </a>
                        </li>
                    </ul>
                    </div>
                </li>
            @endif
        </ul>    
    @else
        <ul id="accordion1" class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{route('login')}}">Employee Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{route('admin.login')}}">Admin Login</a>
            </li>
        </ul>
    @endif
</div>