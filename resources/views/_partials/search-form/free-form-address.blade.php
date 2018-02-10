<form method="GET" action="{{ route(package('welcome')) }}">
    <h5>Your Location</h5>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{-- <label for="">Address</label> --}}
                <input placeholder="e.g Changi Terminal 1" class="form-control" type="text" name="my_address" value="{{ request()->get('my_address', isset($myAddress) ? $myAddress : null) }}">
            </div>
        </div>
    </div>

    <h5>Your Destination</h5>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{-- <label for="">Address</label> --}}
                <input placeholder="e.g Sentosa" class="form-control" type="text" name="dest_address" value="{{ request()->get('dest_address', isset($destAddress) ? $destAddress : null) }}">
            </div>
        </div>
    </div>

    <button type="submit" name="submit" value="address" class="btn btn-success btn-block">Search</button>
</form>

@push('header')
    <script type="text/javascript">
        $(function () {
            addressLists = function () {
                var el = $(this);
                var val = $(this).val();
            }

            $('input[name=dest_address]').on('keyup', addressLists);
            $('input[name=my_address]').on('keyup', addressLists);
        });
    </script>
@endpush
