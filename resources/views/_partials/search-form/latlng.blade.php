<form method="GET" action="{{ route(package('welcome')) }}">
    <h5>Your Location</h5>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Latitude</label>
                <input class="form-control" type="text" name="my_lat" value="{{ request()->get('my_lat', isset($myLat) ? $myLat : null) }}">
            </div>

            <div class="form-group">
                <label for="">Longitude</label>
                <input class="form-control" type="text" name="my_lng" value="{{ request()->get('my_lng', isset($myLng) ? $myLng : null) }}">
            </div>
        </div>
    </div>

    <h5>Your Destination</h5>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Latitude</label>
                <input class="form-control" type="text" name="dest_lat" value="{{ request()->get('dest_lat', isset($destLat) ? $destLat : null) }}">
            </div>

            <div class="form-group">
                <label for="">Longitude</label>
                <input class="form-control" type="text" name="dest_lng" value="{{ request()->get('dest_lng', isset($destLng) ? $destLng : null) }}">
            </div>
        </div>
    </div>

    <button type="submit" name="submit" value="lat-lng" class="btn btn-success btn-block">Search</button>
</form>
