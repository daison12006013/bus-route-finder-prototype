<h3>Suggested Routes</h3>

<div class="alert alert-info">
    Currently working on the sorting of bus matching on each latitude and longitude.
</div>

<table class="final-routes table">
    <thead class="thead-dark">
        <tr>
            <th><i class="fa fa-map-marker"></i> Latitude &amp; Longitude</th>
            <th><i class="fa fa-bus"></i> Buses</th>
        </tr>
    </thead>
    @forelse ($routes as $latLng => $buses)
        <tr>
            <td>{{ str_replace(':', ', ', $latLng) }}</td>
            <td>{{ implode(', ', $buses) }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="2">No Record found.</td>
        </tr>
    @endforelse
</table>
