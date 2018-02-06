@extends('bus-router-sg::_layouts.main')

@section('title', 'Welcome to Bus Router Singapore')

@section('header')
@endsection

@section('content')
    <div class="row">
        <div class="margin-top-3 col-md-12">
            <div class="row">
                <div class="col-md-4">
                    @include('bus-router-sg::_partials.search-form')
                </div>

                <div class="col-md-8">
                    @include('bus-router-sg::_partials.nearest-bus', [
                        'title' => 'Buses on your location',
                        'nearestBuses' => $myNearestBus,
                    ])
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    @include('bus-router-sg::_partials.search-results')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection
