<x-paginator id="comment-paginator" class="mb-4" :paginator="$comments" />

<div id="topic-comments-container">
    @foreach($comments as $comment)
    <x-comment.sub-tree :comment="$comment" />
    @endforeach
</div>

<x-paginator class="mt-4" :paginator="$comments" />