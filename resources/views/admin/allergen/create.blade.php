<x-layout.standard>
    @slot('title')
        create storage location
    @endslot
    @section('content')
        <form action="{{ route('admin.allergen.store') }}" method="post">
            @method('PUT')
            @csrf
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="name">name</label>
            <input allergen="text" name="name" id="allergen-name">

            <button allergen="submit">save</button>
        </form>
    @endsection
</x-layout.standard>
