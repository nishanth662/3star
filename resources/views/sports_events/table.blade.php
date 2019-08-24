<div class="table-responsive">
    <table class="table" id="table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Ground</th>
        <th>Date</th>
        <th>Time</th>
        <th>Price</th>
        <th>Image</th>
        <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($sportsEvents as $sportsEvents)
            <tr>
                <td>{!! $sportsEvents->name !!}</td>
            <td>{!! $sportsEvents->sports->name !!}</td>
            <td>{!! $sportsEvents->date !!}</td>
            <td>{!! $sportsEvents->time !!}</td>
            <td>{!! $sportsEvents->price !!}</td>
            <td><button class="btn btn-default" type="button" data-toggle="modal" data-target="#images{{$sportsEvents->id}}">Images</button></td>
                <td>
                    {!! Form::open(['route' => ['sportsEvents.destroy', $sportsEvents->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('sportsEvents.show', [$sportsEvents->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('sportsEvents.edit', [$sportsEvents->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            <div class="modal fade" id="images{{$sportsEvents->id}}" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="border: none">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-center">Sports Images</h4>
                        </div>
                        <div class="modal-body">
                            @foreach($sportsEvents->images as $image)
                                <div class="col-md-3">
                                    <img src="{{asset('avatars').'/'.$image->image}}" style="width: 100%;height: 100px;">
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer" style="border: none">
                            {{--                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
        </tbody>
    </table>
</div>
