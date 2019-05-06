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
    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group">
                        <a href="index.html" class="list-group-item active main-color-bg">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
                        </a>
                        <?php
                            $users = App\User::all();
                        ?>
                        <a href="/manage" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Manage Staff <span class="badge">{{count($users)}}</span></a>
                    </div>
                </div>
                @yield('sub-contents')
            </div>
        </div>
    </section>
</section>  
@endsection