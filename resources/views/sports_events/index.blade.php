@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Sports Events</h1>
        <h1 class="pull-right">
            @if(Auth::user()->super_admin == 1)<a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('sportsEvents.create') !!}">Add New</a>@endif
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('sports_events.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

