<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Ground Field -->
<div class="form-group col-sm-12">
    {!! Form::label('ground', 'Ground:') !!}
    <select id="" name="ground" class="form-control">
        <option value="" selected disabled>Select a sport</option>
        @foreach($sports as $sport)
            <option value="{{$sport->id}}" @if(isset($sportsEvents) && $sportsEvents->ground == $sport->id) selected @endif>{{$sport->name}}</option>
        @endforeach
    </select>

</div>

<!-- Date Field -->
<div class="form-group col-sm-12">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::text('date', null, ['class' => 'form-control','id'=>'datePicker','readonly']) !!}
</div>

<!-- Time Field -->
<div class="form-group col-sm-12">
    {!! Form::label('time', 'Time:') !!}
    {!! Form::text('time', null, ['class' => 'form-control','id'=>'timePicker']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('end_date', 'End Date:') !!}
    {!! Form::text('end_date', null, ['class' => 'form-control','id'=>'datePicker1','readonly']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-12">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <input type="file" name="image[]" class="form-control" accept="image/*" multiple>
    @if(isset($sportsEvents))
        @foreach($sportsEvents->images as $image)
            <div class="col-md-3">
                <img src="{{asset('avatars').'/'.$image->image}}" style="width: 50%;height: 100px;">
            </div>
        @endforeach
    @endif
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('sportsEvents.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script>
        $(function () {
            $("#datePicker1").datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
                startDate: new Date()
            }).datepicker('update', new Date());
            $("#datePicker").datepicker({
                autoclose: true,
                startDate: new Date(),
                format: "dd-mm-yyyy"
            }).datepicker('update', new Date());
            $(function () {
                $('#timePicker').datetimepicker({
                    format: 'LT'
                });
            });
        });
    </script>
@endsection
