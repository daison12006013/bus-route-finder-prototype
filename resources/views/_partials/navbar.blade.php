@php
    function put_active_matched_route($name, $return) {
        return Route::currentRouteName() === $name ? $return : null;
    }
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Bus Router Singapore</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ put_active_matched_route('bus-router-sg::welcome', 'active') }}">
                <a class="nav-link" href="{!! route('bus-router-sg::welcome') !!}">Home {!! put_active_matched_route('bus-router-sg::welcome', '<span class="sr-only">(current)</span>') !!}</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item {{ put_active_matched_route('bus-router-sg::login', 'active') }}">
                @php
                    $loginOrAccountName = 'Login';

                    if (isset($user) && $user) {
                        $loginOrAccountName = sprintf('Welcome %s!', $user->name);
                    }
                @endphp

                <a class="nav-link" href="{!! route('bus-router-sg::login') !!}">{{ $loginOrAccountName }} {!! put_active_matched_route('bus-router-sg::login', '<span class="sr-only">(current)</span>') !!}</a>
            </li>
        </ul>
    </div>
</nav>
