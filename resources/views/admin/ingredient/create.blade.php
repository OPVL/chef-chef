<x-layout.standard>
    @slot('title')
        create ingredient
    @endslot

    @section('content')
        <form action="{{ route('admin.ingredient.store') }}" method="post">
            @method('PUT')
            @csrf
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="name">name</label>
            <input type="text" name="name" id="ingredient-name">

            @error('unit')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="name">unit</label>
            <select name="unit_id" id="unit_id    ">
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach
            </select>

            @error('type')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="name">storage location</label>
            <select name="type_id" id="type_id    ">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>

            <button type="submit">save</button>
        </form>
    @endsection
</x-layout.standard>
