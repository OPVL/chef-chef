<x-layout.standard>
    @slot('title')
        recipes
    @endslot

    @section('content')
        @isset($success)
            {{ $success }}
        @endisset
        <table>
            <thead>
                <th>ID</th>
                <th>NAME</th>
                <th>DESCRIPTION</th>
                <th>CUISINE</th>
                <th>VIEW</th>
                <th>EDIT</th>
                @if (true || (Auth::user() && Auth::user()->is_super))
                    <th>DELETE</th>
                @endif
            </thead>
            @foreach ($recipes as $recipe)
                <tr>
                    <td>{{ $recipe->id }}</td>
                    <td>{{ $recipe->name }}</td>
                    <td>{{ $recipe->description }}</td>
                    <td>{{ $recipe->cuisine->name }}</td>
                    <td><a href="{{ route('recipe.get', $recipe) }}">view</a></td>
                    <td><a href="{{ route('recipe.edit', $recipe) }}">edit</a></td>
                    {{-- <td>{{ $recipe->ingredients->count }}</td> --}}
                    @if (true || (Auth::user() && Auth::user()->is_super))
                        <td>
                            <form action="{{ route('recipe.delete', $recipe) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="confirm" id="confirmation-input">
                                <input type="submit" value="delete" onclick="return deleteConfirm('{{ $recipe->name }}')">
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
