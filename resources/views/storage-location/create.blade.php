<x-layout.standard>
    @slot('title')
        create storage location
    @endslot
    @section('content')
        <form action="{{ route('storage-location.store') }}" method="post">
            @method('PUT')
            @csrf
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="name">name</label>
            <input type="text" name="name" id="storage-location-name">

            <button type="submit">save</button>
        </form>
    @endsection
</x-layout.standard>
