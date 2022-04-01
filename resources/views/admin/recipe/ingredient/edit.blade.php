<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit ingredients - {{ $recipe->name }}</title>
</head>

<body>
    <h1>edit ingredients</h1>
    <hr>
    <form action="{{ route('admin.recipe.ingredient.update', $recipe) }}" method="post">
        @method('PATCH')
        @csrf
        @error('ingredient')
            <div class="alert danger">{{ $message }}</div>
        @enderror

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
                        value="{{ old("quantity[{$ingredient->id}]") ?? $ingredient->pivot->quantity }}" step="any">
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

        <button type="submit">save</button>
    </form>
</body>

</html>
