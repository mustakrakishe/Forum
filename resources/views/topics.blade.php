@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js\pages\topics.js') }}" defer></script>
    <script src="{{ asset('js\components\modal.js') }}" defer></script>
    <script src="{{ asset('js\components\form.js') }}" defer></script>
@endsection

@section('content')
    <x-container class="mt-0 d-flex justify-content-between">
        <h2 class="m-0 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Topics') }}
        </h2>
        
        @auth
            <x-button data-toggle="modal" data-target="#create-topic-modal">
                <i class="fas fa-plus mr-2"></i>
                {{ __('New topic') }}
            </x-button>
            <x-topic.create/>
        @endauth
    </x-container>

    @if(count($topics) > 0)
        @foreach($topics as $topic)
            <x-container>
                <div class="row">
                    <div class="col-2">
                        <div class="row">{{ $topic->author->name }}</div>
                        <div class="row">{{ $topic->created_at }}</div>
                    </div>
                    <div class="col">
                        <div class="row">{{ $topic->title }}</div>
                        <div class="row">{{ $topic->content }}</div>
                    </div>
                </div>
            </x-container>
        @endforeach
    @else
        <x-container>
            {{ __('There are no topics yet.') }}
        </x-container>
    @endif
@endsection
