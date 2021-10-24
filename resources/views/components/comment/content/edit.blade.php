<div name="edit-mode-content">

    <form
        name="update-comment-form"
        action="{{ route('topics.comments.update', ['topic' => $comment->topic_id, 'comment' => $comment->id]) }}"
        method="post"
    >
        @csrf
        @method('PUT')

        <div name="body" class="row m-0 my-2">
            <x-textarea name="text" class="text-justify" style="resize: none; min-height: 81px" autofocus>{{ $comment->text }}</x-textarea>
        </div>

        <div name="footer" class="row m-0 justify-content-end">
            <x-button type="reset" class="btn-secondary mr-1">{{ __('actions.cancel') }}</x-button>
            <x-button type="submit">{{ __('actions.update') }}</x-button>
        </div>

    </form>

</div>