@props(['comment', 'pl' => 0])

<div {{ $attributes->merge(['style' => 'padding-left: ' . $pl . 'px;']) }}>
    <div class="d-flex mt-4 p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <div class="pl-0 mt-1 d-flex justify-content-center" style="width: 92px;">
            <div>
                <div class="text-center h5">{{ $comment->author->name }}</div>
                <div class="text-center small text-muted">{{ substr($comment->created_at, 0, 10) }}</div>
                <div class="text-center small text-muted">{{ substr($comment->created_at, 11, 5) }}</div>
            </div>
        </div>

        <div class="ml-3 w-100" style="overflow: visible;">
            <x-comment.show :comment="$comment"/>
        </div>
        
    </div>
</div>

@if(isset($comment->answer_tree))
    @foreach($comment->answer_tree as $answer)
        <x-comment :comment="$answer" :pl="$pl + 50"/>
    @endforeach
@endif