<div name="comment-container" class='d-flex mt-4 pr-4 py-2 bg-white shadow-sm sm:rounded-lg'>

    <div class="mt-4 d-flex justify-content-center" style="width: 150px;">
        <div>
            <div class="text-center h5">{{ $comment->author->name }}</div>
        </div>
    </div>

    <div name="content" class="w-100">
        <x-dynamic-component :component="'comment.content.'.$mode" :comment="$comment"/>
    </div>

</div>