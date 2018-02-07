@extends('bus-router-sg::_layouts.main')

@section('title', 'Add a Bus')

@section('header')
@endsection

@section('content')
    <div class="margin-top-3 col-md-5 mx-auto">
        @include('bus-router-sg::_partials.bus.add-form')
    </div>
@endsection

@section('footer')
@endsection
