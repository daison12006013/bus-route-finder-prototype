@extends(package('_layouts.main'))

@section('title', 'Welcome to Bus Router Singapore')

@section('content')
    @if (isset($routes) && $routes)
        @include(package('index.after-search'))
    @else
        @include(package('index.before-search'))
    @endif
@endsection
