@extends('layouts.app')

@section('content')
    <div class="container col-md-9" style="padding-left:3em; padding-top:1em">
        <div class="row card">
            <div class="card-content">
                <div class="card-title">Add Department</div>
                {!! Form::open(['action' => 'DepartmentsController@store', 'method' => 'POST']) !!}
                    <div class="col-md-4 form-group">
                        {{Form::label('name', 'Department Name')}}
                        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Department Name'])}}
                    </div>
                    <div class="col-md-4 form-group">
                        {{Form::label('short_name', 'Department Short Name')}}
                        {{Form::text('short_name', '', ['class' => 'form-control', 'placeholder' => 'Department Short Name'])}}
                    </div>
                    <div class="col-md-4 form-group">
                        {{Form::label('code', 'Department Code')}}
                        {{Form::text('code', '', ['class' => 'form-control', 'placeholder' => 'Department Code'])}}
                    </div>
                    <div class="col-md-3">
                        {{Form::submit('ADD', ['class' => 'btn btn-primary'])}}
                    </div>
                {!! Form::close() !!}
                </div>
        </div>
    </div>
@endsection