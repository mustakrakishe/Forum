<div id="comment-show-component">
    <div class="row pb-2 d-flex align-items-end justify-content-between">

        @if($comment->author->is(Auth::user()))
        <div class="col-auto pr-0">
            <div class="btn-group" role="group" aria-label="Basic example">

                <form id="edit-comment-form" action="{{ route('comments.edit', ['comment' => $comment->id]) }}" method="get">
                    <button class="btn btn-light" name="edit">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                </form>

                <form action="{{ route('comments.destroy', ['comment' => $comment->id]) }}" method="post">
                    @csrf
                    {{ method_field('delete') }}
                    
                    <button class="btn btn-light" name="delete">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </form>

            </div>
        </div>
        @endif

    </div>

    <div class="row">
        <x-textarea id="comment-text" class="col p-0 border-0 bg-transparent text-justify" style="resize: none;" disabled>{{ $comment->text }}</x-textarea>
    </div>
</div>