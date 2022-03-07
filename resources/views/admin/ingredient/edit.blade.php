<x-layout.standard>
    @slot('title')
        edit {{ $ingredient->name }}
    @endslot

    @section('content')
        <form action="{{ route('ingredient.update', $ingredient) }}" method="post">
            @method('PATCH')
            @csrf
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="name">name</label>
            <input type="text" name="name" id="ingredient-name" value="{{ $ingredient->name }}">

            @error('unit')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="name">unit</label>
            <select name="unit_id" id="unit_id">
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}" @if ($ingredient->unit_id === $unit->id) selected @endif>
                        {{ $unit->name }}</option>
                @endforeach
            </select>

            @error('type')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="name">storage location</label>
            <select name="type_id" id="type_id">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" @if ($ingredient->type_id === $type->id) selected @endif>
                        {{ $type->name }}</option>
                @endforeach
            </select>

            <button type="submit">update</button>
        </form>
    @endsection
</x-layout.standard>
