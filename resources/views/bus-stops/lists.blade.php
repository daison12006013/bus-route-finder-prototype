@extends(package('_layouts.main'))

@section('title', 'Lists of Bus Stops')

@section('content')
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Bus Station Code</th>
                <th>Name</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Buses</th>
            </tr>
        </thead>
        @forelse ($busStops as $idx => $busStop)
            <tr data-raw="{{ json_encode($busStop->toArray()) }}">
                <td>{{ $busStop['bus_station_code'] }}</td>
                <td>{{ $busStop['name'] }}</td>
                <td>{{ $busStop['lat'] }}</td>
                <td>{{ $busStop['lng'] }}</td>
                <td>
                    {!! implode('&nbsp;', random_badge(collect($busStop['buses'])->pluck('bus_number')->all())) !!}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No Record found.</td>
            </tr>
        @endforelse
    </table>

    <div class="row">
        <div class="mx-auto">
            {{ $busStops->links() }}
        </div>
    </div>
@endsection
