@php
    $randomizeBadge = function ($records) {
        return collect($records)->map(function ($record) {
            $badges = ['success', 'info', 'primary', 'danger', 'dark'];

            return sprintf('<span class="badge badge-%s">%s</span>', $badges[array_rand($badges)], $record);
        })->all();
    };
@endphp

<h3>Final Routes</h3>

<table class="final-routes table">
    <thead class="thead-dark">
        <tr>
            <th><i class="fa fa-bus"></i> Buses</th>
            <th><i class="fa fa-map-marker"></i> Description</th>
        </tr>
    </thead>
    @forelse ($routes as $idx => $route)
        @php
            $firstLoc = reset($route['locations']);
            $lastLoc = end($route['locations']);
            $isStart = $idx === 0;
            $isEnd = ($idx+1) === count($routes);
            $destinationDistance = number_format($destNearestBus->first()->distance, 2);
        @endphp

        @if ($isStart)
            <tr>
                <td colspan="2">
                    <h4 class="text-center">
                        <span class="badge badge-seconday">Start</span>
                    </h4>
                </td>
            </tr>
        @endif

        <tr>
            <td>
                @if (count($route['buses']) > 1)
                    Take any of these buses {!! implode('&nbsp;', call_user_func($randomizeBadge, $route['buses'])) !!}
                @else
                    Take this bus {!! implode('&nbsp;', call_user_func($randomizeBadge, $route['buses'])) !!}
                @endif
            </td>
            <td>
                @if ($isStart)
                    Walk to bus station
                @else
                    From this bus station
                @endif

                <span class="text-warning">({{ $firstLoc['bus_station_code'] }})</span> <strong class="text-primary">{{ $firstLoc['name'] }}</strong> ride a bus, and it will take <strong class="text-primary">{{ $routeLocationCount = count($route['locations']) }}</strong> {{ str_plural('stop', $routeLocationCount) }} to go at <span class="text-warning">({{ $lastLoc['bus_station_code'] }})</span> <strong class="text-primary">{{ $lastLoc['name'] }}</strong>

                @if ($isEnd && $destinationDistance != 0)
                    and walk to your destination which is estimated around {{ $destinationDistance }} KM.
                @endif
            </td>
        </tr>

        @if ($isEnd)
            <tr>
                <td colspan="2">
                    <h4 class="text-center">
                        <span class="badge badge-seconday">Ends here!</span>
                    </h4>
                </td>
            </tr>
        @endif
    @empty
        <tr>
            <td colspan="2">No Record found.</td>
        </tr>
    @endforelse
</table>
