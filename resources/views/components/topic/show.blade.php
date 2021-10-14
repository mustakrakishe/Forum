<x-container>
    <div class="row m-0">

        <div class="col-2 pl-0 mt-2 d-flex justify-content-center">
            <div>
                <div class="text-center h5">{{ $topic->author->name }}</div>
                <div class="text-center small text-muted">{{ substr($topic->created_at, 0, 10) }}</div>
                <div class="text-center small text-muted">{{ substr($topic->created_at, 11, 5) }}</div>
            </div>
        </div>

        <div id="topic-content" class="col">
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

                        <form action="" method="get">
                            <button class="btn btn-light" name="delete">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>

                    </div>
                </div>
                @endif
            </div>

            <div class="row text-justify">{{ $topic->description }}</div>
        </div>

    </div>
</x-container>