@extends('principal_admin.layout')

@section('sub-contents')
    <div class="container col-md-9">
        <div class="row card">
            <div class="card-content">
                <div class="card-title">Edit Department</div>
                {!! Form::open(['action' => ['DepartmentsController@update', $department->id], 'method' => 'POST']) !!}
                    <div class="col-md-4 form-group">
                        {{Form::label('name', 'Department Name')}}
                        {{Form::text('name', $department->name, ['class' => 'form-control', 'placeholder' => 'Department Name'])}}
                    </div>
                    <div class="col-md-4 form-group">
                        {{Form::label('short_name', 'Department Short Name')}}
                        {{Form::text('short_name', $department->short_name, ['class' => 'form-control', 'placeholder' => 'Department Short Name'])}}
                    </div>
                    <div class="col-md-4 form-group">
                        {{Form::label('code', 'Department Code')}}
                        {{Form::text('code', $department->code, ['class' => 'form-control', 'placeholder' => 'Department Code'])}}
                    </div>
                    <div class="col-md-3">
                        {{Form::hidden('_method', 'PUT')}}
                        {{Form::submit('EDIT', ['class' => 'btn btn-primary'])}}
                    </div>
                {!! Form::close() !!}
                </div>
        </div>
    </div>
@endsection