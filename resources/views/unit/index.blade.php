<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>units</title>
</head>

<body>
    @isset($success)
        {{ $success }}
    @endisset
    <table>
        <thead>
            <th>ID</th>
            <th>NAME</th>
            <th>LABEL</th>
            <th>EDIT</th>
        </thead>
        @foreach ($units as $unit)
            <tr>
                <td>{{ $unit->id }}</td>
                <td>{{ $unit->name }}</td>
                <td>{{ $unit->label }}</td>
                <td><a href="{{ route('unit.edit', $unit) }}">edit</a></td>
            </tr>
        @endforeach
    </table>
</body>

</html>
