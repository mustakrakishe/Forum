@props(['comment', 'pl' => 0])

<div {{ $attributes->merge([
    'class' => 'm-0',
    'style' => 'padding-left: ' . $pl . 'px;'
]) }} >

    &#10149; {{ $comment->id }} - {{ $comment->created_at }}

    @if(isset($comment->answer_tree))
        @foreach($comment->answer_tree as $answer)
            <x-comment :comment="$answer" :pl="20"/>
        @endforeach
    @endif

</div>