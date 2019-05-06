@extends('layouts.app')

@section('content')
    <div class="container col-md-9" style="padding-left:3em; padding-top:1em">
        <div class="row card">
            <div class="card-content">
                <div class="card-title">Manage Leave Type</div>
                <div class="table-responsive">
                    <table class="table table-hover" id="dt">
                        @if (count($leavetype) > 0)
                            <thead>
                                <th>#</th>
                                <th>Leave Type</th>
                                <th>Description</th>
                                <th>Creation Date</th>
                                <th></th>
                            </thead>
                            <?php $count = 1; ?>
                            <tbody>
                                @foreach ($leavetype as $type)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$type->leave_type}}</td>
                                        <td>{{ strip_tags($type->description) }}</td>
                                        <td>{{$type->created_at->toDateString()}}</td>
                                        <td>
                                            <a href="/leavetype/{{$type->id}}/edit"><i class="fa fa-edit"></i> Edit</a>
                                            {!!Form::open(['action' => ['LeaveTypeController@destroy', $type->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                <i style="color:red" class="fa fa-trash">
                                                {{Form::submit(' Delete', ['style' => 'background-color:transparent; border:none; color:red; font-style:sans-serif', 'onclick' => 'return confirm(\'Are you sure you want to delete\')'])}}
                                                </i>
                                            {!!Form::close()!!}
                                        </td>
                                    </tr>
                                    <?php $count++; ?>
                                @endforeach
                            </tbody>
                        @else
                            <p>There Are No Leave Types. Add a Type <a href="/leavetype/create">here.</a></p>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection