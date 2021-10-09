@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js\pages\topics.js') }}"></script>
    <script src="{{ asset('js\components\dialog.js') }}"></script>
    <script src="{{ asset('js\components\form.js') }}"></script>
@endsection

@section('content')
    <x-container class="mt-0 d-flex justify-content-between">
        <h2 class="m-0 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Topics') }}
        </h2>
        
        @auth
        <form id="create-form" action="{{ route('topics.create') }}"></form>
        <x-button onclick="xhrSendForm('create-form', 'action')">
            <i class="fas fa-plus mr-2"></i>
            {{ __('pages/topics.Create new') }}
        </x-button>
        @endauth
    </x-container>

    <x-container>
        <div>Перечень тем</div>
    </x-container>
@endsection
