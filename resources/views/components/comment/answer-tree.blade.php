@props(['comment', 'pl' => 0])

<div {{ $attributes->merge(['style' => 'padding-left: ' . $pl . 'px;']) }}>
    <div class="d-flex mt-4 pr-4 py-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <div class="mt-4 d-flex justify-content-center" style="width: 150px;">
            <div>
                <div class="text-center h5">{{ $comment->author->name }}</div>
            </div>
        </div>

        <x-comment.show class="w-100" :comment="$comment"/>

    </div>
</div>

@if(isset($comment->answer_tree))
    @foreach($comment->answer_tree as $answer)
        <x-comment.answer-tree :comment="$answer" :pl="$pl + 70"/>
    @endforeach
@endif