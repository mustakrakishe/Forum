<div name="comment-sub-tree">

    <x-comment :mode="'show'" :comment="$comment" />

    <div name="answers-container" style="padding-left: 70px;">
        @if(isset($comment->answer_tree))

            @foreach($comment->answer_tree as $answer)
                <x-comment.sub-tree :comment="$answer"></x-comment.sub-tree>
            @endforeach
            
        @endif
    </div>

</div>
