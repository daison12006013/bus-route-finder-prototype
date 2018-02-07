@extends('bus-router-sg::_layouts.main')

@section('title', 'Welcome to Bus Router Singapore')

@section('header')
<style media="screen">
    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 80vw;
            margin: 1.75rem auto;
        }
    }
</style>
@endsection

@section('content')
    <div class="modal" id="exampleModalLong">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Search</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
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
            </div>
        </div>
    </div>

    <div class="margin-top-3 row">
        <div class="col-md-12 text-center">
            <p class="text-primary"><small>
                {{ request()->get('my_lat', $myLat) }}:{{ request()->get('my_lng', $myLng) }}
                <span class="fa fa-chevron-right"></span>
                {{ request()->get('dest_lat', $destLat) }}:{{ request()->get('dest_lng', $destLng) }}
            </small></p>
            <a href="#" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#exampleModalLong">
                Search
            </a>
        </div>
    </div>

    <div class="margin-top-3 row">
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
