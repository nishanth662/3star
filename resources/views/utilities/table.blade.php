<div class="table-responsive">
    <table class="table" id="utilities-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Image</th>
        <th>Address</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($utilities as $utility)
            <tr>
                <td>{!! $utility->name !!}</td>
            <td>{!! $utility->image !!}</td>
            <td>{!! $utility->address !!}</td>
                <td>
                    {!! Form::open(['route' => ['utilities.destroy', $utility->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('utilities.show', [$utility->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('utilities.edit', [$utility->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
