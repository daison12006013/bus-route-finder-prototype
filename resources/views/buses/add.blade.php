@extends(package('_layouts.main'))

@section('title', 'Add a Bus')

@section('content')
    <div class="mt-4 col-md-5 mx-auto">
        @include(package('_partials.bus.add-form'))
    </div>
@endsection
