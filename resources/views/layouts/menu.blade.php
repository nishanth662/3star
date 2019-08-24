@if(Auth::user()->super_admin == 1)
{{--<li class="{{ Request::is('admins*') ? 'active' : '' }}">--}}
{{--    <a href="{!! route('admins.index') !!}"><i class="fa fa-user"></i><span>Admins</span></a>--}}
{{--</li>--}}

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-user"></i><span>Users</span></a>
</li>
@endif
<li class="{{ Request::is('utilities*') ? 'active' : '' }}">
    <a href="{!! route('utilities.index') !!}"><i class="fa fa-futbol-o"></i><span>Utilities</span></a>
</li>

{{--<li class="{{ Request::is('sportsEvents*') ? 'active' : '' }}">--}}
{{--    <a href="{!! route('sportsEvents.index') !!}"><i class="fa fa-futbol-o"></i><span>Sports Events</span></a>--}}
{{--</li>--}}

