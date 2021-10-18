<x-comment.layout :author="$author">

    <div name="body" class="row m-0 my-2">
        <x-textarea name="description" class="text-justify p-0" style="resize: none; min-height: 69px"></x-textarea>
    </div>

    <div name="footer" class="row m-0 text-muted small">
        <a href="#" class="card-link">{{ __('actions.create') }}</a>
    </div>

</x-comment.layout>