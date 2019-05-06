@extends('layouts.app')

@section('content')
    <div class="container col-md-9" style="padding-left:3em; padding-top:1em">
        <div class="row card">
            <div class="card-content">
                <div class="card-title">Manage Departments</div>
                <div class="table-responsive">
                    <table class="table table-hover" id="dt">
                        @if (count($departments) > 0)
                            <thead>
                                <th>#</th>
                                <th>Department Name</th>
                                <th>Department Short Name</th>
                                <th>Department Code</th>
                                <th>Created at</th>
                                <th></th>
                            </thead>
                            <?php $count = 1; ?>
                            <tbody>
                                @foreach ($departments as $department)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$department->name}}</td>
                                        <td>{{$department->short_name}}</td>
                                        <td>{{$department->code}}</td>
                                        <td>{{$department->created_at->toDateString()}}</td>
                                        <td>
                                            <a href="/departments/{{$department->id}}/edit"><i class="fa fa-edit"></i> Edit</a>
                                            {!!Form::open(['action' => ['DepartmentsController@destroy', $department->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                <i style="color:red" class="fa fa-trash">
                                                {{Form::submit(' Delete', ['style' => 'background-color:transparent; border:none; color:red; font-style:sans-serif', 'onclick' => 'return confirm(\'Are you sure you want to delete?\')'])}}
                                                </i>
                                            {!!Form::close()!!}     
                                        </td>
                                    </tr>
                                    <?php $count++; ?>
                                @endforeach
                            </tbody>
                        @else
                            <p>There Are No Departments. Add a Department <a href="/departments/create">here.</a></p>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection