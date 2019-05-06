@extends('layouts.app')

@section('content')
    <div class="container col-md-9" style="padding-left:3em; padding-top:1em">
        <div class="row card">
            <div class="card-content">
                <div class="card-title">Leave Application</div>
                {!! Form::open(['action' => 'LeavesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="col-md-4 form-group">
                        {{Form::label('type', 'Leave Type')}}
                        @if (count($leavetypes) > 0)
                            <select name="type" id="type" class="form-control" onchange="datediff()">
                                    <option value="">LeaveType..</option>
                                    @foreach ($leavetypes as $leavetype)
                                        <option value="{{$leavetype}}">{{$leavetype}}</option>
                                    @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="col-md-3 form-group">
                        {{Form::label('from_date', 'From Date')}}
                        {{Form::date('from_date', '', ['onchange' => 'datediff()', 'id' => 'from', 'class' => 'form-control', 'placeholder' => 'From Date'])}}
                    </div>
                    <div class="col-md-3 form-group">
                        {{Form::label('to_date', 'To Date (inclusive)')}}
                        {{Form::date('to_date', '', ['onchange' => 'datediff()', 'id' => 'to', 'class' => 'form-control', 'placeholder' => 'To Date'])}}
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="attachments">Documents</label>
                        <input type="file" name="attachments[]" id="attachments" class="form-control" multiple>
                    </div>
                    <div class="col-md-3 form-group">
                        {{Form::label('days_applied', 'Total Days Applied For')}}
                        {{Form::number('days_applied', '', ['id' => 'days_applied', 'class' => 'form-control', 'placeholder' => '# of days', 'readonly'])}}
                    </div>
                    <div class="col-md-10 form-group">
                        {{Form::label('description', 'Reasons for application')}}
                        {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control desc', 'placeholder' => 'Job Description'])}}
                    </div>
                    <div class="col-md-3">
                        {{Form::submit('APPLY', ['class' => 'btn btn-primary'])}}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection