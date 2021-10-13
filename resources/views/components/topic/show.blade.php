<x-container>
    <div class="row m-0">

        <div class="col-2">
            <div class="row">{{ $topic->author->name }}</div>
            <div class="row">{{ $topic->created_at }}</div>
        </div>

        <div class="col">
            <div class="row">{{ $topic->title }}</div>
            <div class="row">{{ $topic->content }}</div>
        </div>

        @if($topic->author->is(Auth::user()))
            <div class="col-auto pr-0">
                <div class="btn-group" role="group" aria-label="Basic example">

                    <button type="button" class="btn btn-light" name="edit">
                        <i class="fas fa-pencil-alt"></i>
                    </button>

                    <button type="button" class="btn btn-light" name="delete">
                        <i class="far fa-trash-alt"></i>
                    </button>

                </div>
            </div>
        @endif

    </div>
</x-container>