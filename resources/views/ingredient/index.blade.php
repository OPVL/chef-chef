<x-layout.standard>
    @slot('title')
        ingredients
    @endslot

    @section('content')
        @isset($success)
            {{ $success }}
        @endisset
        <table>
            <thead>
                <th>ID</th>
                <th>NAME</th>
                <th>UNIT</th>
                <th>TYPE</th>
                <th>EDIT</th>
                @if (true || (Auth::user() && Auth::user()->is_super))
                    <th>DELETE</th>
                @endif
            </thead>
            @foreach ($ingredients as $ingredient)
                <tr>
                    <td>{{ $ingredient->id }}</td>
                    <td>{{ $ingredient->name }}</td>
                    <td>{{ $ingredient->unit->name }}</td>
                    <td>{{ $ingredient->type->name }}</td>
                    <td><a href="{{ route('ingredient.edit', $ingredient) }}">edit</a></td>
                    @if (true || (Auth::user() && Auth::user()->is_super))
                        <td>
                            <form action="{{ route('ingredient.delete', $ingredient) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="confirm" id="confirmation-input">
                                <input type="submit" value="delete" onclick="return deleteConfirm('{{ $ingredient->name }}')">
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
