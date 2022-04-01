<x-layout.standard>
    @slot('title')
        create cuisine
    @endslot

    @section('content')
        <form action="{{ route('admin.cuisine.store') }}" method="post">
            @method('PUT')
            @csrf
            @error('name')
                <div class="alert danger">{{ $message }}</div>
            @enderror
            <label for="name">name</label>
            <input type="text" name="name" id="cuisine-name">

            @error('description')
                <div class="alert danger">{{ $message }}</div>
            @enderror
            <label for="name">description</label>
            <input type="text" name="description" id="cuisine-description">

            <button type="submit">next</button>
        </form>
    @endsection
</x-layout.standard>
