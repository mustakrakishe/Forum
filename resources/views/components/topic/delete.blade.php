@props(['id'])

<x-modal id="delete-topic-modal">
    <x-slot name="title">{{ __('confirmation.headers.delete', ['entity' => __('confirmation.entities.Topic')]) }}</x-slot>

    <p>{{ __('confirmation.messages.delete', ['entity' => __('confirmation.entities.Topic')]) }}</p>

    <x-slot name="footer" class="bg-dark">
        <form id="delete-topic-form" action="{{ route('topics.destroy', ['topic' => $id]) }}" method="post">
            @csrf
            {{ method_field('delete') }}

            <button name="cancel" type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('actions.cancel') }}</button>
            <button name="delete" class="btn btn-danger">{{ __('actions.delete') }}</button>
        </form>
    </x-slot>
</x-modal>