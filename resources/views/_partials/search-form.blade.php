<form method="GET" action="{{ route('bus-router-sg::welcome') }}">
    <h5>Your Location</h5>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Latitude</label>
                <input class="form-control" type="text" name="my_lat" value="{{ request()->get('dest_lng', $myLat) }}">
            </div>

            <div class="form-group">
                <label for="">Longitude</label>
                <input class="form-control" type="text" name="my_lng" value="{{ request()->get('dest_lng', $myLng) }}">
            </div>
        </div>
    </div>

    <h5>Your Destination</h5>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Latitude</label>
                <input class="form-control" type="text" name="dest_lat" value="{{ request()->get('dest_lng', $destLat) }}">
            </div>

            <div class="form-group">
                <label for="">Longitude</label>
                <input class="form-control" type="text" name="dest_lng" value="{{ request()->get('dest_lng', $destLng) }}">
            </div>
        </div>
    </div>

    <button type="submit" name="submit" class="btn btn-success btn-block">Search</button>
</form>
