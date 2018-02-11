@extends(package('_layouts.main'))

@section('title', 'Add a Bus Stop')

@section('content')
    <div class="margin-top-3 col-md-5 mx-auto">
        @include(package('_partials.bus.add-form'))
    </div>
@endsection
