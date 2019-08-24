@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Sports Events
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($sportsEvents, ['route' => ['sportsEvents.update', $sportsEvents->id], 'method' => 'patch','files'=>true]) !!}

                        @include('sports_events.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection