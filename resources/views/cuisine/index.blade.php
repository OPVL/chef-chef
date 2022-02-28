<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>cuisine index</title>
</head>

<body>
    <table>
        <thead>
            <th>ID</th>
            <th>NAME</th>
            <th>DESCRIPTION</th>
        </thead>
        @foreach ($cuisines as $cuisine)
            <tr>
                <td>{{ $cuisine->id }}</td>
                <td>{{ $cuisine->name }}</td>
                <td>{{ $cuisine->description }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
