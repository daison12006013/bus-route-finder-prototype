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
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item {{ if_route_match('login', 'active') }}">
                @php
                    $loginOrAccountName = '<span class="fa fa-lock"></span> Login';

                    if (Auth::check() && $user = Auth::user()) {
                        $loginOrAccountName = sprintf('<span class="fa fa-user-circle"></span> Welcome %s!', $user->name);
                    }
                @endphp

                <a class="nav-link" href="{!! route(package('login')) !!}">{!! $loginOrAccountName !!} {!! if_route_match('login', '<span class="sr-only">(current)</span>') !!}</a>
            </li>

            @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{!! route(package('logout')) !!}"><span class="fa fa-power-off"></span> Logout</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
