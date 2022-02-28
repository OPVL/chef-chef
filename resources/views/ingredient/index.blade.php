<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ingredients</title>
</head>

<body>
    @isset($success)
        {{ $success }}
    @endisset
    <table>
        <thead>
            <th>ID</th>
            <th>NAME</th>
            <th>UNIT</th>
            <th>STORAGE LOCATION</th>
            <th>EDIT</th>
        </thead>
        @foreach ($ingredients as $ingredient)
            <tr>
                <td>{{ $ingredient->id }}</td>
                <td>{{ $ingredient->name }}</td>
                <td>{{ $ingredient->unit->name }}</td>
                <td>{{ $ingredient->storageLocation->name }}</td>
                <td><a href="{{ route('ingredient.edit', $ingredient) }}">edit</a></td>
            </tr>
        @endforeach
    </table>
</body>

</html>
