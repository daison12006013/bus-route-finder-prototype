@extends(package('_layouts.main'))

@section('title', 'Login')

@section('content')
    <div class="mt-4 col-md-5 mx-auto">
        @include(package('_partials.login-form'))
    </div>
@endsection
