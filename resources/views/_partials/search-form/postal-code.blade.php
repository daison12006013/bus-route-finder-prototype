<form method="GET" action="{{ route(package('welcome')) }}">
    <h5>Your Location</h5>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{-- <label for="">Postal Code</label> --}}
                <input placeholder="e.g 348573" class="form-control" type="text" name="my_postal_code" value="{{ request()->get('my_postal_code', isset($myPostalCode) ? $myPostalCode : null) }}">
            </div>
        </div>
    </div>

    <h5>Your Destination</h5>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{-- <label for="">Postal Code</label> --}}
                <input placeholder="e.g 188979" class="form-control" type="text" name="dest_postal_code" value="{{ request()->get('dest_postal_code', isset($destPostalCode) ? $destPostalCode : null) }}">
            </div>
        </div>
    </div>

    <button type="submit" name="submit" value="postal-code" class="btn btn-success btn-block">Search</button>
</form>


@push('header')
    <script type="text/javascript">
        $(function () {
            postalCodes = function () {
                var el = $(this);
                var val = $(this).val();
            }

            $('input[name=my_postal_code]').on('keyup', postalCodes);
            $('input[name=dest_postal_code]').on('keyup', postalCodes);
        });
    </script>
@endpush
