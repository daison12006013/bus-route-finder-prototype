@php
    $defaultTab = Daison\BusRouterSg\Http\Controllers\Welcome::SEARCH_BY_POSTAL_CODE;
@endphp
<div id="search-form">
    <ul id="search-form-tab-links" class="nav nav-tabs">
        {{-- <li class="nav-item">
            <a class="nav-link active show" data-toggle="tab" href="#address">Address</a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->get('submit', $defaultTab) === Daison\BusRouterSg\Http\Controllers\Welcome::SEARCH_BY_POSTAL_CODE ? 'active show' : '' }}" data-toggle="tab" href="#postal-code">Postal Code</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->get('submit', $defaultTab) === Daison\BusRouterSg\Http\Controllers\Welcome::SEARCH_BY_LAT_LNG ? 'active show' : '' }}" data-toggle="tab" href="#lat-lng">Lat &amp; Lng</a>
        </li>
    </ul>
    <div id="search-form-tab-contents" class="tab-content">
        {{-- <div class="tab-pane fade active show" id="address">
            @include(package('_partials.search-form.free-form-address'))
        </div> --}}
        <div class="tab-pane fade {{ request()->get('submit', $defaultTab) === Daison\BusRouterSg\Http\Controllers\Welcome::SEARCH_BY_POSTAL_CODE ? 'active show' : '' }}" id="postal-code">
            @include(package('_partials.search-form.postal-code'))
        </div>
        <div class="tab-pane fade {{ request()->get('submit', $defaultTab) === Daison\BusRouterSg\Http\Controllers\Welcome::SEARCH_BY_LAT_LNG ? 'active show' : '' }}" id="lat-lng">
            @include(package('_partials.search-form.latlng'))
        </div>
    </div>
</div>
