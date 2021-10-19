<x-comment.layout :author="$author">
    <form
        name="store-comment-form"
        action="{{ route('topics.comments.store', ['topic' => $topicId, 'answerToId' => $answerToId]) }}"
        validation="{{ route('topics.comments.validate', ['topic' => $topicId]) }}"
        method="post"
    >
        @csrf

        <div name="body" class="row m-0 my-2">
            <x-textarea id="comment-d" name="text" class="text-justify" style="resize: none; min-height: 81px" autofocus></x-textarea>
        </div>

        <div name="footer" class="row m-0 justify-content-end">
            <x-button type="reset" class="btn-secondary mr-1">{{ __('actions.cancel') }}</x-button>
            <x-button type="submit">{{ __('actions.create') }}</x-button>
        </div>

    </form>
</x-comment.layout>