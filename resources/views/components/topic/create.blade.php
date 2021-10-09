<div class="modal-dialog modal-lg" id="create-topic-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">{{ __('New topic') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="create-form" action="" validate="">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="col-form-label">{{ __('Title') }}:</label>
                        <input type="text" class="form-control" id="title">
                    </div>

                    <div class="mb-3">
                        <label for="content" class="col-form-label">{{ __('Content') }}</label>
                        <textarea class="form-control" id="content"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                    onclick="cancelDialog('create-topic-modal')"
                >
                    {{ __('Cancel') }}
                </button>
                
                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="xhrValidateForm('create-form');"
                >
                    {{ __('Save') }}
                </button>
            </div>

        </div>
    </div>
</div>