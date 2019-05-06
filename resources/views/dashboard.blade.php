@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-1" style="padding-top:30px">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size:1.5em">Welcome to the Leave Management System</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p style="padding:30px">You are now logged in!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
