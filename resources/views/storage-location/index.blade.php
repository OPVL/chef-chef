<x-layout.standard>
    @slot('title')
        storage locations
    @endslot
    @section('content')
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
    @endsection
    @section('scripts')
        <script>
            function deleteConfirm(name) {
                const confirmation = confirm(`Are you sure you want to delete ${name}`);
                document.getElementById('confirmation-input').value = confirmation;
                return confirmation;
            }
        </script>
    @endsection
</x-layout.standard>
