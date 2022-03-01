<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create ingredient</title>
</head>

<body>
    <form action="{{ route('ingredient.store') }}" method="post">
        @method('PUT')
        @csrf
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="name">name</label>
        <input type="text" name="name" id="ingredient-name">

        @error('unit')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="name">unit</label>
        <select name="unit_id" id="unit_id    ">
            @foreach ($units as $unit)
                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
            @endforeach
        </select>

        @error('type')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="name">storage location</label>
        <select name="type_id" id="type_id    ">
            @foreach ($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>

        <button type="submit">save</button>
    </form>
</body>

</html>
