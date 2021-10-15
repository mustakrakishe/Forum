<div id="topic-show-component">
    <div class="row pb-2 d-flex align-items-end justify-content-between">
        
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

                <form action="{{ route('topics.destroy', ['topic' => $topic->id]) }}" method="post">
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
        <x-textarea id="topic-description" class="col p-0 border-0 bg-transparent text-justify" style="resize: none;" disabled>{{ $topic->description }}</x-textarea>
    </div>
</div>