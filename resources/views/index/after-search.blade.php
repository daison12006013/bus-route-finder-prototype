{{--
This is the after you clicked the search button.
--}}
<div class="modal" id="search-container">
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
                            @include(package('_partials.search-form'))
                        </div>

                        <div class="col-md-8">
                            @include(package('_partials.nearest-bus'), [
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

<div class="mt-4 row">
    <div class="col-md-12 text-center">
        <p class="text-primary"><small>
            @if (request()->get('submit') === Daison\BusRouterSg\Http\Controllers\Welcome::SEARCH_BY_LAT_LNG)
                {{ request()->get('my_lat') }}:{{ request()->get('my_lng') }}
            @elseif (request()->get('submit') === Daison\BusRouterSg\Http\Controllers\Welcome::SEARCH_BY_POSTAL_CODE)
                {{ request()->get('my_postal_code') }}
            @endif

            <span class="fa fa-chevron-right"></span>

            @if (request()->get('submit') === Daison\BusRouterSg\Http\Controllers\Welcome::SEARCH_BY_LAT_LNG)
                {{ request()->get('dest_lat') }}:{{ request()->get('dest_lng') }}
            @elseif (request()->get('submit') === Daison\BusRouterSg\Http\Controllers\Welcome::SEARCH_BY_POSTAL_CODE)
                {{ request()->get('dest_postal_code') }}
            @endif
        </small></p>

        {{-- either show the modal or go to the other page --}}
        <a href="{{ route(package('static-view'), ['blade' => 'search']) }}" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#search-container">
            Search
        </a>
    </div>
</div>

<div class="mt-4 row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                @include(package('_partials.search-results'))
            </div>
        </div>
    </div>
</div>
