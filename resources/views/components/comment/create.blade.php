<x-comment.layout :author="$author">
    <form name="store-comment-form" action="{{ route('topics.comments.store', ['topic' => $topic->id]) }}" validation="{{ route(topics.comments.validate) }}" method="post">

        <div name="body" class="row m-0 my-2">
            <x-textarea id="comment-d" name="description" class="text-justify" style="resize: none; min-height: 81px" autofocus></x-textarea>
        </div>

        <div name="footer" class="row m-0 justify-content-end">
            <x-button type="reset" class="btn-secondary mr-1">{{ __('actions.cancel') }}</x-button>
            <x-button type="submit">{{ __('actions.create') }}</x-button>
        </div>

    </form>
</x-comment.layout>