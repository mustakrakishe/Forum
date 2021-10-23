@extends('layouts.app')

@section('scripts')
<script type="module" src="{{ asset('js\views\topics\index.js') }}" defer></script>
@endsection

@section('content')
    <x-container id="page-title-container" class="mt-0 d-flex justify-content-between">
        <h2 class="m-0 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Topics') }}
        </h2>

        @auth
            <x-button data-toggle="modal" data-target="#create-topic-modal">
                <i class="fas fa-plus mr-2"></i>
                {{ __('New Topic') }}
            </x-button>
            
            <x-topic.create />
        @endauth
    </x-container>

    @if(count($topics) > 0)
        <div class="list-group">

            @foreach($topics as $topic)
                <x-topic.index :topic="$topic"/>
            @endforeach
        
        </div>
    @else
        <x-container>{{ __('There are no topics yet.') }}</x-container>
    @endif

@endsection