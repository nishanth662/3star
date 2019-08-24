<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>
@if(!isset($admin))
<div class="form-group col-sm-12">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::text('password', null, ['class' => 'form-control','minlength'=>'8']) !!}
</div>
@endif
<!-- Sports Field -->
<div class="form-group col-sm-12">
    {!! Form::label('sports', 'Sports:') !!}
    <select id="" name="sports_id" class="form-control">
        <option value="" selected disabled>Select a sport</option>
        @foreach($sports as $sport)
            <option value="{{$sport->id}}" @if(isset($admin) && $admin->sport_id == $sport->id) selected @endif>{{$sport->name}}</option>
        @endforeach
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admins.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <script>
        $('#sports').select2({
            minimumInputLength : 1,
            placeholder : "Search Sports",
            ajax: {
                url: '{{ url("search_sports") }}',
                processResults: function (data) {
                    // Tranforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data
                    };
                }
            }
        });
    </script>
@endsection
