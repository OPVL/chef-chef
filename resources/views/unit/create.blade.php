<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create unit</title>
</head>

<body>
    <form action="{{ route('unit.store') }}" method="post">
        @method('PUT')
        @csrf
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="name">name</label>
        <input type="text" name="name" id="name">

        @error('label')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="name">label</label>
        <input type="text" name="label" id="label">

        <button type="submit">save</button>
    </form>
</body>

</html>
