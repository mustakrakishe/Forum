@props(['topicId'])

<x-modal id="delete-comment-modal">
    <x-slot name="title">{{ __('confirmation.headers.delete', ['entity' => __('confirmation.entities.comment')]) }}</x-slot>

    <p>{{ __('confirmation.messages.delete', ['entity' => __('confirmation.entities.comment')]) }}</p>

    <x-slot name="footer" class="bg-dark">
        <form id="delete-comment-form" action="{{ route('topics.comments.destroy', ['topic' => $topicId, 'comment' => '#']) }}" method="post">
            @csrf
            {{ method_field('delete') }}

            <button name="cancel" type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('actions.cancel') }}</button>
            <button name="delete" class="btn btn-danger">{{ __('actions.delete') }}</button>
        </form>
    </x-slot>
</x-modal>