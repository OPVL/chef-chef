<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create recipe</title>
</head>
<body>
    <form action="{{ route('recipe.store') }}" method="post">
        @method('PUT')
        @csrf
        <label for="name">name</label>
        <input type="text" name="name" id="recipe-name">

        <label for="name">description</label>
        <input type="text" name="description" id="recipe-description">

        <button type="submit">next</button>
    </form>
</body>
</html>
