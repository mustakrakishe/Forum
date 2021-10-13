<a href="{{ route('topics.show', ['topic' => $topic->id]) }}" class="list-group-item-action">
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

                    <button type="button" class="btn btn-light" name="delete">
                        <i class="far fa-trash-alt"></i>
                    </button>
                    
                </div>
            @endif

        </div>
    </x-container>
</a>