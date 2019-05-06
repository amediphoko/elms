@extends('layouts.app')
<style>
    html, body {
        font-family: 'Raleway', sans-serif !important;
        font-weight: 100 !important;
        height: 100vh !important;
        margin: 0 !important;
    }

    #sidebar {
        display: none;
    }

    .content {
        text-align: center;
        padding: 10px;
        margin-top:20px;
    }

    .title {
        font-size: 40px;
        padding-bottom: 20px;
    }

    .links > a {
        color: #636b6f;
        padding: 15px 30px;
        margin-right: 50px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .links a#admin-login {
        border: 2px solid steelblue;
        background: #fff;
        color: steelblue;
    }

    .links a#emp-login {
        border: 2px solid green;
        background: #fff;
        color: green;
    }

    .links a#admin-login:hover {
        background:steelblue;
        color: #fff;
    }

    .links a#emp-login:hover {
        background:green;
        color: #fff;
    }

    .links #emp-login.active {
        background: steelblue;
    }

    .panel {
        margin:0;
        padding: 50px;
        border: none !important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.05), 
        0 3px 1px -2px rgba(0, 0, 0, 0.08), 
        0 1px 100px 0 rgba(0, 0, 0, 0.08) !important;
    }

</style>
@section('content')
    <div class="container">
        <div class="content">
            <div class="title m-b-md">
                Nanogang Leave Management System
            </div>
            
            <div class="links">
                <a class="btn btn-default" id="emp-login" href="{{url('/login')}}">Employee Login</a>
                <a class="btn btn-primary" id="admin-login" href="{{route('admin.login')}}">Principal Login</a>
            </div>

            <div class="emp-login">
                @yield('subcontent')
            </div>
        </div>
    </div>
@endsection