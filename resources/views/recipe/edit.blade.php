<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit {{ $recipe->name }}</title>
</head>

<body>
    <form action="{{ route('recipe.update', $recipe) }}" method="post">
        @method('PATCH')
        @csrf
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="name">name</label>
        <input type="text" name="name" id="recipe-name" value="{{ $recipe->name }}">

        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="name">description</label>
        <input type="text" name="description" id="recipe-description" value="{{ $recipe->description }}">

        @error('cuisine')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="name">cuisine</label>
        <select name="cuisine_id" id="cuisine_id    ">
            @foreach ($cuisines as $cuisine)
                <option value="{{ $cuisine->id }}" @if ($recipe->cuisine_id === $cuisine->id) selected @endif>
                    {{ $cuisine->name }}</option>
            @endforeach
        </select>

        <button type="submit">update</button>
    </form>
</body>

</html>
