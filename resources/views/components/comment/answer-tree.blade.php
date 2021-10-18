@props(['comment', 'pl' => 0])

<div {{ $attributes->merge(['style' => 'padding-left: ' . $pl . 'px;']) }}>
    <x-comment.show :comment="$comment"/>
</div>

@if(isset($comment->answer_tree))
    @foreach($comment->answer_tree as $answer)
        <x-comment.answer-tree :comment="$answer" :pl="$pl + 70"/>
    @endforeach
@endif