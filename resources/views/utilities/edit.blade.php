@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Utility
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($utility, ['route' => ['utilities.update', $utility->id], 'method' => 'patch']) !!}

                        @include('utilities.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection