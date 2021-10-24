@extends('layouts.app')

@section('scripts')
<script type="module" src="{{ asset('js\views\topics\topic.js') }}" defer></script>
<script type="module" src="{{ asset('js\views\topics\comment.js') }}" defer></script>
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

@auth
<x-comment.delete :topicId="$topic->id"/>
@endauth

<x-comment.index id="topic-comments-container" class="mt-4" :comments="$comments"/>

@endsection