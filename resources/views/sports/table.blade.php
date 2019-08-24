<div class="table-responsive">
    <table class="table" id="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Location</th>
                <th>Admin Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($sports as $sports)
            @php
                $User = \App\User::where('sports_id',$sports->id)->first();
            @endphp
            <tr>
                <td>{!! $sports->name !!}</td>
            <td><button class="btn btn-default" type="button" data-toggle="modal" data-target="#images{{$sports->id}}">Images</button></td>
            <td>{!! $sports->location !!}</td>
            <td>{!! $User->email !!}</td>
                <td>
                    {!! Form::open(['route' => ['utilities.destroy', $sports->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
{{--                        <a href="{!! route('sports.show', [$sports->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                        <a href="{!! route('utilities.edit', [$sports->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        @if(Auth::user()->super_admin == 1)
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        @endif
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            <div class="modal fade" id="images{{$sports->id}}" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="border: none">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-center">Sports Images</h4>
                        </div>
                        <div class="modal-body">
                            @foreach($sports->images as $image)
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
