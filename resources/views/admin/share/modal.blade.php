<div wire:ignore.self class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="exampleModalLabel">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! $content !!}
            </div>
            <div class="modal-footer">
                {!! $footer !!}
                <button
                    type="button"
                    data-dismiss="modal"
                    class="btn btn-gradient-primary">{{ isset($btnCloseName) ? $btnCloseName : 'Close' }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->