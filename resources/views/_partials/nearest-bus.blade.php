<h3>{{ $title }}</h3>

<table class="final-routes table">
    <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Distance (in KM)</th>
            <th>Bus Station Code</th>
            <th>Latitude</th>
            <th>Longitude</th>
        </tr>
    </thead>
    @forelse ($nearestBuses as $nearestBus)
        <tr>
            <td>{{ $nearestBus->name }}</td>
            <td>{{ round($nearestBus->distance, 2) }}</td>
            <td>{{ $nearestBus->bus_station_code }}</td>
            <td>{{ $nearestBus->lat }}</td>
            <td>{{ $nearestBus->lng }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="6">No Record found.</td>
        </tr>
    @endforelse
</table>

<div class="row">
    <div class="mx-auto">
        {{ $nearestBuses->links() }}
    </div>
</div>
