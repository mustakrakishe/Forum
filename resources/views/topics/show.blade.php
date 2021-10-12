@extends('layouts.app')

@section('scripts')
    <script type="module" src="{{ asset('js\view\topics.js') }}" defer></script>
    <script src="{{ asset('js\components\modal.js') }}" defer></script>
@endsection

@section('content')
    <x-topic.index :topic="$topic"/>
@endsection
