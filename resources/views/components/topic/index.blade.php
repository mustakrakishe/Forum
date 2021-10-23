<a name="topic" href="{{ route('topics.show', ['topic' => $topic->id]) }}" class="list-group-item list-group-item-action border mt-3" aria-current="true">

    <div class="row h4 m-0">{{ $topic->header }}</div>
    <div class="col-2 p-0 text-muted">{{ $topic->author->name }}</div>
    <div class="col p-0 text-muted small">{{ $topic->created_at }}</div>

</a>