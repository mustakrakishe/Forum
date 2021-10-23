<div id="topic-edit-component">
    <form id="update-topic-form" name="my" action="{{ route('topics.update', ['topic' => $topic->id]) }}" method="put">
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
            <x-textarea id="topic-description" name="description" class="text-justify" style="resize: none">{{ $topic->description }}</x-textarea>
        </div>
        
    </form>
</div>