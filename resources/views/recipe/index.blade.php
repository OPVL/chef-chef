<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>recipe index</title>
</head>

<body>
    <table>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>DESCRIPTION</th>
            <th>INGREDIENTS</th>
        </tr>
        @foreach ($recipes as $recipe)
            <tr>
                <td>{{ $recipe->id }}</td>
                <td>{{ $recipe->name }}</td>
                <td>{{ $recipe->description }}</td>
                <td>{{ $recipe->ingredients->count }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
