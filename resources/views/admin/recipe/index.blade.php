<x-layout.admin>
    @slot('title')
        recipes
    @endslot

    @section('content')
        @if (session()->has('success'))
            {{ session()->get('success') }}
        @endif
        <button onclick="navigate('{{route('admin.recipe.create') }}')">new</button>
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
                    <td><a href="{{ route('admin.recipe.get', $recipe) }}">view</a></td>
                    <td><a href="{{ route('admin.recipe.edit', $recipe) }}">edit</a></td>
                    {{-- <td>{{ $recipe->ingredients->count }}</td> --}}
                    @if (true || (Auth::user() && Auth::user()->is_super))
                        <td>
                            <form action="{{ route('admin.recipe.delete', $recipe) }}" method="post" id="delete-{{ $recipe->name }}">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="confirm" id="confirmation-input-{{ $recipe->name }}">
                                <a href="javascript:deleteConfirm('{{ $recipe->name }}')">delete</a>
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
                document.getElementById(`confirmation-input-${name}`).value = confirmation;

                if (confirmation) {
                    document.getElementById(`delete-${name}`).submit();
                }
            }
        </script>
    @endsection
</x-layout.admin>
