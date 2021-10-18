<div class="d-flex mt-4 pr-4 py-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">

    <div class="mt-4 d-flex justify-content-center" style="width: 150px;">
        <div>
            <div class="text-center h5">{{ $author->name }}</div>
        </div>
    </div>

    <div class="w-100">
        {{ $slot }}
    </div>

</div>