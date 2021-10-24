@props(['comments'])

<div {{ $attributes }}>
    <div name="paginaton-links-wrapper" class="mb-4">
        {{ $comments->links() }}
    </div>

    @foreach($comments as $comment)
    <x-comment.sub-tree :comment="$comment"/>
    @endforeach
    
    <div name="paginaton-links-wrapper" class="mt-4">
        {{ $comments->links() }}
    </div>
</div>