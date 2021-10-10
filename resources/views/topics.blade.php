@extends('layouts.app')

@section('scripts')
    <script type="module" src="{{ asset('js\pages\topics.js') }}" defer></script>
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

            <x-modal id="create-topic-modal" class="modal-lg modal-dialog-scrollable">
                <x-slot name="title">{{ __('New topic') }}</x-slot>

                <form>
                    <div class="form-group">
                        <label for="topic-title" class="col-form-label">{{ __('Title') }}</label>
                        <input type="text" id="topic-title" class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label for="topic-content" class="col-form-label">{{ __('Content') }}</label>
                        <textarea id="topic-content" class="form-control"></textarea>
                    </div>
                </form>

                <x-slot name="footer" class="bg-dark">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-primary">{{ __('Create') }}</button>
                </x-slot>
            </x-modal>
        @endauth
    </x-container>

    <x-container>
        <div>Перечень тем</div>
    </x-container>
@endsection
