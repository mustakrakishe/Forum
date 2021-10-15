<x-modal id="create-topic-modal" class="modal-lg modal-dialog-scrollable">
    <x-slot name="title">{{ __('New topic') }}</x-slot>

    <form id="create-topic-form" method="post" action="{{ route('topics.store') }}" validation="{{ route('topics.validate') }}">
        @csrf

        <div class="form-group">
            <label for="topic-header" class="col-form-label">{{ __('Header') }}</label>
            <input type="text" id="topic-header" class="form-control" name="header">
        </div>

        <div class="form-group">
            <label for="topic-description" class="col-form-label">{{ __('Description') }}</label>
            <x-textarea id="topic-description" initHeight="250" name="description" style="min-height: 250px;"></x-textarea>
        </div>

    </form>

    <x-slot name="footer" class="bg-dark">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
        <button class="btn btn-primary" form="create-topic-form">{{ __('Create') }}</button>
    </x-slot>
</x-modal>