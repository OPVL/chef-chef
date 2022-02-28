<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $storageLocation->name }}</title>
</head>

<body>
    <h1>{{ $storageLocation->name }}</h1>
    <hr>
    <div>
        <h4>Ingredients</h4>
        <table>
            <thead>
                <th>NAME</th>
            </thead>
            <tbody>
                @foreach ($storageLocation->ingredients as $ingredient)
                    <tr>
                        <td>{{ $ingredient->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
