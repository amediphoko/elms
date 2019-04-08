@extends('layouts.app')

@section('content')
    <div class="container col-md-9" style="padding-left:3em; padding-top:1em">
        <div class="row card">
            <div class="card-content">
                <div class="card-title">Edit Leave Type</div>
                {!! Form::open(['action' => ['LeaveTypeController@update', $leavetype->id], 'method' => 'POST']) !!}
                <div class="col-md-4 form-group">
                        {{Form::label('leavetype', 'Leave Type')}}
                        {{Form::text('leavetype', $leavetype->leave_type, ['class' => 'form-control', 'placeholder' => 'Leave Type'])}}
                    </div>
                    <div class="col-md-9 form-group">
                        {{Form::label('description', 'Description')}}
                        {{Form::textarea('description', $leavetype->description, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Description'])}}
                    </div>
                    <div class="col-md-7">
                        {{Form::hidden('_method', 'PUT')}}
                        {{Form::submit('EDIT', ['class' => 'btn btn-primary'])}}
                    </div>
                {!! Form::close() !!}
                </div>
        </div>
    </div>
@endsection