@extends('layouts.app')

@section('content')
    <div class="container col-md-9" style="padding-left:3em; padding-top:1em">
        <div class="row card">
            <div class="card-content">
                <div class="card-title">Leave Application</div>
                {!! Form::open(['action' => 'LeavesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="col-md-4 form-group">
                        {{Form::label('type', 'Leave Type')}}
                        {{Form::select('type', array('Annual' => 'Annual', 'Sick' => 'Sick', 'Maternity' => 'Maternity', 'Compassionate' => 'Compassionate',
                        'Study' => 'Study', 'Unpaid' => 'Unpaid'), 'Annual', ['class' => 'form-control'])}}
                    </div>
                    <div class="col-md-3 form-group">
                        {{Form::label('from_date', 'From Date')}}
                        {{Form::date('from_date', '', ['class' => 'form-control', 'placeholder' => 'From Date'])}}
                    </div>
                    <div class="col-md-3 form-group">
                        {{Form::label('to_date', 'To Date (inclusive)')}}
                        {{Form::date('to_date', '', ['class' => 'form-control', 'placeholder' => 'To Date'])}}
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="attachments">Documents</label>
                        <input type="file" name="attachments[]" id="attachments" class="form-control" multiple>
                    </div>
                    <div class="col-md-3 form-group">
                        {{Form::label('days_applied', 'Total Days Applied For')}}
                        {{Form::number('days_applied', '', ['class' => 'form-control', 'placeholder' => '# of days'])}}
                    </div>
                    <div class="col-md-10 form-group">
                        {{Form::label('description', 'Reasons for application')}}
                        {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Job Description'])}}
                    </div>
                    <div class="col-md-3">
                        {{Form::submit('APPLY', ['class' => 'btn btn-primary'])}}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection