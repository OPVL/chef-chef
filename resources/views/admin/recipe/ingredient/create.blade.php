<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>select ingredients - {{ $recipe->name }}</title>
</head>

<body>
    <h1>select ingredients</h1>
    <p>you'll be able to choose quantities in the next step</p>
    <hr>
    <form action="{{ route('recipe.ingredient.store', $recipe) }}" method="post">
        @method('PUT')
        @csrf
        @error('ingredient')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @foreach ($groups as $location => $ingredients)
            <div>
                <h4>{{ $location }}</h4>
                @foreach ($ingredients as $ingredient)
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
