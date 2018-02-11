@extends(package('_layouts.main'))

@section('title', 'Lists of Buses')

@section('content')
    <div class="col-md-8 mx-auto">
        <div class="mx-auto mt-4 mb-4">
            <form class="" method="GET">
                <div class="form-row">
                    <div class="col-2 text-center">
                        <label class="mt-3">Keyword</label>
                    </div>
                    <div class="col-8">
                        <input class="form-control" type="text" name="keyword" value="{{ old('keyword', request()->get('keyword')) }}" placeholder="e.g Bus No / Station Code or Name">
                    </div>
                    <div class="col-2">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>

        <table class="table">
            @forelse ($buses as $idx => $bus)
                <tr data-raw="{{ json_encode($bus->toArray()) }}">
                    <td>
                        <h4 class="text-center">Bus #{{ $bus['bus_number'] }}</h4>
                        @for ($i = 1; $i <= $bus['bus_routes_count']; $i++)
                            <h6 class="text-center">Route {{ $i }}</h6>
                            @php
                                $toRandomize = collect($bus['stops'])
                                    ->where('pivot.route', $i)
                                    ->pluck('bus_station_code')
                                    ->all();
                            @endphp
                            <p>{!! implode('&nbsp;', random_badge($toRandomize)) !!}</p>
                        @endfor
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No Record found.</td>
                </tr>
            @endforelse
        </table>

        <div class="row">
            <div class="mx-auto">
                {{ $buses->appends(
                    request()->except(['page'])
                )->links() }}
            </div>
        </div>

    </div>
@endsection
