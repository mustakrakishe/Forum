@props(['comment'])

<x-comment.show :comment="$comment" />

<div name="comment-sub-tree" style="padding-left: 70px;">
    @if(isset($comment->answer_tree))

        @foreach($comment->answer_tree as $answer)
            <x-comment.node :comment="$answer"/>
        @endforeach
        
    @endif

</div>
