<x-container>
    <div class="row">
        <div class="col-2">
            <div class="row">{{ $topic->author->name }}</div>
            <div class="row">{{ $topic->created_at }}</div>
        </div>
        <div class="col">
            <div class="row">{{ $topic->title }}</div>
            <div class="row">{{ $topic->content }}</div>
        </div>
    </div>
</x-container>