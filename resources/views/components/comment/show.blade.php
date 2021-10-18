<div {{ $attributes }}>

    <div name="header" class="d-flex m-0 text-muted small">
        <div>{{ __('Created at') }}: {{ $comment->created_at }}</div>

        <div class="ml-4">
            @isset($comment->updated_at)
            {{ __('Updated at') }}: {{ $comment->updated_at }}
            @endisset
        </div>

        @if($comment->author->is(Auth::user()))
        <div class="ml-auto">
            <a href="#" class="card-link">{{ __('actions.Edit') }}</a>
            <a href="#" class="card-link">{{ __('actions.Delete') }}</a>
        </div>
        @endif
    </div>

    <div name="body" class="row m-0 my-2">
        <x-textarea class="col p-0 border-0 bg-transparent text-justify" style="resize: none;" disabled>{{ $comment->text }}</x-textarea>
    </div>

    <div name="footer" class="row m-0 text-muted small">
        <a href="#" class="card-link">{{ __('actions.answer') }}</a>
    </div>

</div>