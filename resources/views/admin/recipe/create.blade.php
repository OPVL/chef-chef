<x-layout.admin>
    @slot('title')
        create recipe
    @endslot
    @section('content')
        <form action="{{ route('admin.recipe.store') }}" method="post">
            @method('PUT')
            @csrf
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="name">name</label>
            <input type="text" name="name" id="recipe-name">

            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="name">description</label>
            <input type="text" name="description" id="recipe-description">

            @error('cuisine')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="name">cuisine</label>
            <select name="cuisine_id" id="cuisine_id    ">
                @foreach ($cuisines as $cuisine)
                    <option value="{{ $cuisine->id }}">{{ $cuisine->name }}</option>
                @endforeach
            </select>

            <button type="submit">next</button>
        </form>
    @endsection
</x-layout.admin>
