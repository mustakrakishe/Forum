<div id="topic-edit-component">
    <form id="update-topic-form" name="my" action="{{ route('topics.update', ['topic' => $topic->id]) }}" validation="{{ route('topics.validate') }}" method="put">
        @csrf 

        <div class="row pb-2">

            <div class="col p-0">
                <input type="text" id="topic-header" class="form-control" name="header" value="{{ $topic->header }}">
            </div>
            
            <div class="col-auto pr-0">
                <div class="btn-group" role="group" aria-label="Basic example">
        
                    <button class="btn btn-light" name="update">
                        <i class="fas fa-check"></i>
                    </button>

                    <button id="cancel-edit-button" type="reset" class="btn btn-light" name="cancel-edit">
                        <i class="fas fa-times"></i>
                    </button>

                </div>
            </div>

        </div>

        <div class="row">
<<<<<<< HEAD
            <x-textarea id="topic-description" name="description" class="text-justify" style="resize: none">{{ $topic->description }}</x-textarea>
=======
            <x-textarea id="topic-description" name="description" class="text-justify autoresizable">{{ $topic->description }}</x-textarea>
>>>>>>> a7fb229aee0e32289e1770bfe8ae86f31d7393fe
        </div>
        
    </form>
</div>