@extends('bus-router-sg::_layouts.main')

@section('title', 'Login')

@section('header')
@endsection

@section('content')
    <div class="margin-top-3 col-md-5 mx-auto">
        @include('bus-router-sg::_partials.login-form')
    </div>
@endsection

@section('footer')
@endsection
