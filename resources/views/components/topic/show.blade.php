<div id="topic-show-component">

    <div class="row m-0 pb-2 align-items-end justify-content-between">

        <div class="h3 m-0">
            {{ $topic->header }}
        </div>

        @if($topic->author->is(Auth::user()))
        <div class="col-auto pr-0">
            <div class="btn-group" role="group" aria-label="Basic example">

                <form id="edit-topic-form" action="{{ route('topics.edit', ['topic' => $topic->id]) }}" method="get">
                    <button class="btn btn-light" name="edit">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                </form>
                
                <x-button name="delete" class="btn btn-light" data-toggle="modal" data-target="#delete-topic-modal">
                    <i class="far fa-trash-alt"></i>
                </x-button>
            
                <x-topic.delete :id="$topic->id"/>

            </div>
        </div>
        @endif

    </div>

    <div class="row m-0">
        <p class="m-0 text-justify" style="white-space: break-spaces">{{ $topic->description }}</p>
    </div>

    <div class="row m-0">
        <form name="create-comment-form" action="{{ route('topics.comments.create', ['topic' => $topic->id]) }}">
            <x-button class="btn-link p-0 mb-n4 border-0">{{ __('actions.comment') }}</x-button>
        </form>
    </div>

</div>