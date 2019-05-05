<a data-toggle="modal" data-target="#myModal" style="cursor:pointer">
    <i class="fa fa-plus"></i> Add
</a>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['action' => 'LeaveDaysController@store', 'method' => 'POST']) !!}
                {{ csrf_field() }}
                <input type="number" name="user_id" value="{{$user->id}}" hidden>
                <!-- Header-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Add Leave Days</h4>
                </div>
                <!-- Body -->
                <div class="modal-body">
                    <?php
                        use App\LeaveType;
                        $leavetypes = LeaveType::select('leave_type')->pluck('leave_type');
                    ?>
                    <div class="table-responsive">
                        <table class="table">
                            @if (count($leavetypes) > 0)
                                <thead> 
                                    @foreach ($leavetypes as $leavetype)
                                        <th>{{ $leavetype }} </th>
                                    @endforeach 
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($leavetypes as $leavetype)
                                            <?php
                                                $leavetype_id = LeaveType::where('leave_type',  $leavetype)->value('id');
                                            ?>
                                            <td>
                                                <input type="number" name="{{$leavetype_id}}" value="{{$leavetype_id}}" hidden>
                                                <input type="number" class="form-control" name="{{$leavetype}}" id="{{strtolower($leavetype)}}">
                                            </td>     
                                        @endforeach
                                    </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Days</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>