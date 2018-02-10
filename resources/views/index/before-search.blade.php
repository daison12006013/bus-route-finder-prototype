{{--
This is used when the page is pre-loaded
--}}
<div class="search-box col-md-4 mx-auto">
    @include(package('_partials.search-form'))
</div>

<div class="result-box col-md-8"></div>

@push('styles')
    <style media="screen">
        .result-box {
            display: none;
        }
    </style>
@endpush

@push('scripts')
<script type="text/javascript">
    $(function () {
    });
</script>
@endpush
