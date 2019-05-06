@extends('layouts.app')
    <style>
        #navbar > ul > li > a {
            color:#fff;
        }
    </style>
@section('content')
    <section id="breadcrumb" style="margin-top:20px">
        <div class="container">
            <ol class="breadcrumb">
            <li class="active"><a href="/principaladmin"> Dashboard</a></li>
            </ol>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="/principaladmin" class="list-group-item active main-color-bg">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
                    </a>
                    <?php
                        $users = App\User::all();
                        $departments = App\Department::all();
                    ?>
                    <a href="/manage" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Manage Staff <span class="badge">{{count($users)}}</span></a>
                    <a href="/departments" class="list-group-item"><span class="fa fa-building-o" aria-hidden="true"></span> Manage Departments <span class="badge">{{count($departments)}}</span></a>
                </div>
            </div>
            @yield('sub-contents')
        </div>
    </div>
@endsection