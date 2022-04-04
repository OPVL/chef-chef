<x-layout.admin>
    @slot('title')
        edit ingredients
    @endslot
    @section('content')
        <form class="crud-form wrap-over" action="{{ route('admin.recipe.ingredient.update', $recipe) }}" method="post">
            @method('PATCH')
            @csrf
            @error('ingredient')
                <div class="alert danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
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
                                        value="{{ old("quantity[{$ingredient->id}]") ?? $ingredient->pivot->quantity }}"
                                        required max="1000" step="0.1">
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
