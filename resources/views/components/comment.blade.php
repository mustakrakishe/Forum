@props(['comment', 'pl' => 0])

<div {{ $attributes->merge(['style' => 'padding-left: ' . $pl . 'px;']) }}>
    <x-container>

        <div class="row m-0">

            <div class="col-2 pl-0 mt-2 d-flex justify-content-center">
                <div>
                    <div class="text-center h5">{{ $comment->author->name }}</div>
                    <div class="text-center small text-muted">{{ substr($comment->created_at, 0, 10) }}</div>
                    <div class="text-center small text-muted">{{ substr($comment->created_at, 11, 5) }}</div>
                </div>
            </div>

            <div class="col">
                <x-comment.show :comment="$comment"/>
            </div>
        </div>

    </x-container>
</div>

@if(isset($comment->answer_tree))
    @foreach($comment->answer_tree as $answer)
        <x-comment :comment="$answer" :pl="$pl + 50"/>
    @endforeach
@endif