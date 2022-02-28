<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create cuisine</title>
</head>

<body>
    <form action="{{ route('cuisine.store') }}" method="post">
        @method('PUT')
        @csrf
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="name">name</label>
        <input type="text" name="name" id="cuisine-name">

        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="name">description</label>
        <input type="text" name="description" id="cuisine-description">

        <button type="submit">next</button>
    </form>
</body>

</html>
