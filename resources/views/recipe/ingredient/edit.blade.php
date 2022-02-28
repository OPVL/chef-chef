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
    <form action="{{ route('recipe.ingredient.update', $recipe) }}" method="post">
        @method('PUT')
        @csrf
        @error('ingredient')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @foreach ($locations as $location)
            <div>
                <h4>{{ $location->name }}</h4>
                @foreach ($location->ingredients as $ingredient)
                <label for="ingredient-{{ $ingredient->name }}">{{ $ingredient->name }}</label>
                <input type="checkbox" name="ingredient[]" id="ingredient-{{ $ingredient->name }}"
                value="{{ $ingredient->id }}">
                @endforeach
            </div>
        @endforeach

        <button type="submit">save</button>
    </form>
</body>

</html>