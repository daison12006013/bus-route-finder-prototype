<div id="alert-box" class="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    @if (session()->has('errors'))
                        <ul>
                            @foreach (session()->get('errors')->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    $(function () {
        @if (session()->has('errors'))
            $('#alert-box .modal-title').text('Something went wrong.');
            $('#alert-box').modal('toggle');
        @endif
    });
</script>
@endpush
