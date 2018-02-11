@php
    $isLoggedIn = Auth::check();
@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{!! route(package('welcome')) !!}">Bus Router Singapore</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ if_route_match('welcome', 'active') }}">
                <a class="nav-link" href="{!! route(package('welcome')) !!}"><span class="fa fa-home"></span>  Home {!! if_route_match('welcome', '<span class="sr-only">(current)</span>') !!}</a>
            </li>

            @if ($isLoggedIn)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Management
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route(package('bus-stops')) }}">Bus Stops</a>
                        <a class="dropdown-item" href="{{ route(package('buses')) }}">Buses</a>
                    </div>
                </li>
            @endif
        </ul>
        <ul class="navbar-nav ml-auto">
            @if ($isLoggedIn === false)
                <li class="nav-item {{ if_route_match('login', 'active') }}">
                    <a class="nav-link" href="{!! route(package('login')) !!}"><span class="fa fa-lock"></span> Login {!! if_route_match('login', '<span class="sr-only">(current)</span>') !!}</a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profile-nav-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {!! sprintf('<span class="fa fa-user-circle"></span> Welcome %s!', Auth::user()->name) !!}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="profile-nav-dropdown">
                        <a class="dropdown-item" href="{!! route(package('logout')) !!}">Logout</a>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>
