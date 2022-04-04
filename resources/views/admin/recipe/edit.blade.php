<x-layout.admin>
    @slot('title')
        edit {{ $recipe->name }}
    @endslot
    @section('content')
        <form class="crud-form wrap-over" action="{{ route('admin.recipe.update', $recipe) }}" method="post">
            @method('PATCH')
            @csrf

            <div class="form-group">
                <div class="input-group">
                    @error('name')
                        <div class="alert danger">{{ $message }}</div>
                    @enderror
                    <label for="name">name</label>
                    <input type="text" name="name" id="recipe-name" value="{{ old('name') ?? $recipe->name }}">
                </div>


                <div class="input-group">
                    @error('description')
                        <div class="alert danger">{{ $message }}</div>
                    @enderror
                    <label for="name">description</label>
                    <input type="text" name="description" id="recipe-description"
                        value="{{ old('description') ?? $recipe->description }}">
                </div>

                <div class="input-group">
                    @error('cuisine')
                        <div class="alert danger">{{ $message }}</div>
                    @enderror
                    <label for="name">cuisine</label>
                    <select name="cuisine_id" id="cuisine_id">
                        @foreach ($cuisines as $cuisine)
                            <option value="{{ $cuisine->id }}"
                                {{ (old('cuisine_id') ?? $recipe->cuisine_id) == $cuisine->id ? 'selected' : '' }}>
                                {{ $cuisine->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="form-group">
                <h2>ingredients</h2>
                @foreach ($groups as $type => $ingredients)
                    <div class="ingredient-group">
                        <h4>{{ $type }}</h4>
                        @foreach ($ingredients as $ingredient)
                            <p>{{ $ingredient->name }}</p>
                            <div class="quantity-box">
                                <div class="input-group">
                                    @error('quantity[{{ $ingredient->id }}]')
                                        <div class="alert danger">{{ $message }}</div>
                                    @enderror
                                    <label for="quantity[{{ $ingredient->id }}]">quantity</label>
                                    <input type="number" name="quantity[{{ $ingredient->id }}]"
                                        id="{{ $ingredient->name }}-quantity"
                                        value="{{ old("quantity['{$ingredient->id}']") ?? $ingredient->pivot->quantity }}">
                                </div>

                                <div class="input-group">
                                    @error('unit[{{ $ingredient->id }}]')
                                        <div class="alert danger">{{ $message }}</div>
                                    @enderror
                                    <label for="unit[{{ $ingredient->id }}]">unit</label>
                                    <select name="unit[{{ $ingredient->id }}]" id="{{ $ingredient->name }}-unit">
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}"
                                                @if ($ingredient->unit_id === $unit->id) selected @endif>
                                                {{ $unit->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn main submit">save</button>
        </form>
    @endsection
</x-layout.admin>
