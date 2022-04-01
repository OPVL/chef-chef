<x-layout.admin>
    @slot('title')
        create recipe
    @endslot
    @section('content')
        <form class="crud-form" action="{{ route('admin.recipe.store') }}" method="post">
            @method('PUT')
            @csrf

            <div class="input-group">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="name">name</label>
                <input type="text" name="name" id="recipe-name" placeholder="{{ $namePlaceholder }}"
                    value="{{ old('name') }}">
            </div>

            <div class="input-group">
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="name">description</label>
                <input type="text" name="description" id="recipe-description" placeholder="{{ $descriptionPlaceholder }}"
                    value="{{ old('description') }}">
            </div>

            <div class="input-group">
                @error('cuisine')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="name">cuisine</label>
                <select name="cuisine_id" id="cuisine_id">
                    @foreach ($cuisines as $cuisine)
                        <option value="{{ $cuisine->id }}" {{ old('cuisine_id') == $cuisine->id ? 'selected' : '' }}>
                            {{ $cuisine->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn main submit">save</button>
        </form>
    @endsection
</x-layout.admin>
