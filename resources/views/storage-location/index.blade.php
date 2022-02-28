<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>storage locations</title>
</head>

<body>
    @isset($success)
        {{ $success }}
    @endisset
    <table>
        <thead>
            <th>ID</th>
            <th>NAME</th>
            <th>EDIT</th>
            @if (true || (Auth::user() && Auth::user()->is_super))
                <th>DELETE</th>
            @endif
        </thead>
        @foreach ($storageLocations as $storageLocation)
            <tr>
                <td>{{ $storageLocation->id }}</td>
                <td>{{ $storageLocation->name }}</td>
                <td><a href="{{ route('storage-location.edit', $storageLocation) }}">edit</a></td>
                @if (true || (Auth::user() && Auth::user()->is_super))
                    <td>
                        <form action="{{ route('storage-location.delete', $storageLocation) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="confirm" id="confirmation-input">
                            <input type="submit" value="delete" onclick="return deleteConfirm('something')">
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    </table>
</body>
<script>
    function deleteConfirm(name) {
        const confirmation = confirm(`Are you sure you want to delete ${name}`);
        document.getElementById('confirmation-input').value = confirmation;
        return confirmation;
    }
</script>

</html>
