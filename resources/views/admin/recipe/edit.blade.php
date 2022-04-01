<x-layout.standard>
    @slot('title')
        edit {{ $recipe->name }}
    @endslot
    @section('content')
        <h1>editing {{ $recipe->name }}</h1>
        <form action="{{ route('admin.recipe.update', $recipe) }}" method="post">
            @method('PATCH')
            @csrf
            @error('name')
                <div class="alert danger">{{ $message }}</div>
            @enderror
            <label for="name">name</label>
            <input type="text" name="name" id="recipe-name" value="{{ $recipe->name }}">

            @error('description')
                <div class="alert danger">{{ $message }}</div>
            @enderror
            <label for="name">description</label>
            <input type="text" name="description" id="recipe-description" value="{{ $recipe->description }}">

            @error('cuisine')
                <div class="alert danger">{{ $message }}</div>
            @enderror
            <label for="name">cuisine</label>
            <select name="cuisine_id" id="cuisine_id    ">
                @foreach ($cuisines as $cuisine)
                    <option value="{{ $cuisine->id }}" @if ($recipe->cuisine_id === $cuisine->id) selected @endif>
                        {{ $cuisine->name }}</option>
                @endforeach
            </select>

            <div>
                <h2>ingredients</h2>
                @foreach ($groups as $location => $ingredients)
                    <div>
                        <h4>{{ $location }}</h4>
                        @foreach ($ingredients as $ingredient)
                            <p>{{ $ingredient->name }}</p>
                            @error('quantity[{{ $ingredient->id }}]')
                                <div class="alert danger">{{ $message }}</div>
                            @enderror
                            <label for="quantity[{{ $ingredient->id }}]">quantity</label>
                            <input type="number" name="quantity[{{ $ingredient->id }}]"
                                id="{{ $ingredient->name }}-quantity"
                                value="{{ old("quantity[{$ingredient->id}]") ?? $ingredient->pivot->quantity }}">
                            @error('unit[{{ $ingredient->id }}]')
                                <div class="alert danger">{{ $message }}</div>
                            @enderror
                            <label for="unit[{{ $ingredient->id }}]">unit</label>
                            <select name="unit[{{ $ingredient->id }}]" id="{{ $ingredient->name }}-unit">
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" @if ($ingredient->unit_id === $unit->id) selected @endif>
                                        {{ $unit->name }}</option>
                                @endforeach
                            </select>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <button type="submit">update</button>
        </form>
    @endsection
</x-layout.standard>
