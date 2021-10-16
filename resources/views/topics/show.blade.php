@extends('layouts.app')

@section('scripts')
    <script type="module" src="{{ asset('js\views\topics\show.js') }}" defer></script>
@endsection

@section('content')
    <x-container>
        <div class="row m-0">

            <div class="col-2 pl-0 mt-2 d-flex justify-content-center">
                <div>
                    <div class="text-center h5">{{ $topic->author->name }}</div>
                    <div class="text-center small text-muted">{{ substr($topic->created_at, 0, 10) }}</div>
                    <div class="text-center small text-muted">{{ substr($topic->created_at, 11, 5) }}</div>
                </div>
            </div>

            <div class="col">
                <x-topic.show :topic="$topic"/>
            </div>
        </div>
    </x-container>

    <x-container>
        @foreach($topic->root_comments as $comment)
            <x-comment :comment="$comment"/>
        @endforeach
    </x-container>

    <x-container>
        {{ $topic->root_comments }}
    </x-container>
@endsection
