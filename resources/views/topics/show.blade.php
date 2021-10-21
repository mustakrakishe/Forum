@extends('layouts.app')

@section('scripts')
<script type="module" src="{{ asset('js\views\topics\show.js') }}" defer></script>
@endsection

@section('content')
<x-container name="topic" class="d-flex">

    <div class="mt-2 d-flex justify-content-center" style="width: 150px;">
        <div>
            <div class="text-center h5">{{ $topic->author->name }}</div>
            <div class="text-center small text-muted">{{ substr($topic->created_at, 0, 10) }}</div>
            <div class="text-center small text-muted">{{ substr($topic->created_at, 11, 5) }}</div>
        </div>
    </div>

    <div class="w-100 ml-4">
        <x-topic.show :topic="$topic" />
    </div>
</x-container>

<x-container id="comment-count" name="comment-count" class="text-center">{{ __('statistic.comments', ['count' => count($topic->root_comments, COUNT_RECURSIVE)]) }}</x-container>

@auth
<x-comment.delete :topicId="$topic->id" />
@endauth

<div id="topic-comments-container">
    @foreach($topic->root_comments as $comment)
    <div name="comment-sub-tree">
        <x-comment.node :comment="$comment" />
    </div>
    @endforeach
</div>

@endsection