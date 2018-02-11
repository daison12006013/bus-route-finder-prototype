@extends(package('_layouts.main'))

@section('title', 'Lists of Buses')

@section('content')
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Bus Number</th>
                <th>Number of Routes</th>
            </tr>
        </thead>
        @forelse ($buses as $idx => $bus)
            <tr data-raw="{{ json_encode($bus->toArray()) }}">
                <td>{{ $bus['bus_number'] }}</td>
                <td>{{ $bus['bus_routes_count'] }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2">No Record found.</td>
            </tr>
        @endforelse
    </table>

    <div class="row">
        <div class="mx-auto">
            {{ $buses->links() }}
        </div>
    </div>
@endsection
