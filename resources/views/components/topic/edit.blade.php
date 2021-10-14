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

                    <button class="btn btn-light" name="cancel-edit" form="cancel-edit-form">
                        <i class="fas fa-times"></i>
                    </button>

            </div>
        </div>

    </div>

    <div class="row">
        <div name="fake-description" class="form-control h-auto" contenteditable="true">
            {{ $topic->description }}
        </div>
        <input type="hidden" name="description">
    </div>
    
</form>

<form id="cancel-edit-form" action="" method="get"></form>