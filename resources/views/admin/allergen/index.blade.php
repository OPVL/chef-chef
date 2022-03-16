<x-layout.admin>
    @slot('title')
        allergens
    @endslot
    @section('content')
        @if (session()->has('success'))
            {{ session()->get('success') }}
        @endif
        <table>
            <thead>
                <th>ID</th>
                <th>NAME</th>
                <th>ANIMAL PRODUCT</th>
                <th>EDIT</th>
                @if (true || (Auth::user() && Auth::user()->is_super))
                    <th>DELETE</th>
                @endif
            </thead>
            @foreach ($allergens as $allergen)
                <tr>
                    <td>{{ $allergen->id }}</td>
                    <td>{{ $allergen->name }}</td>
                    <td>{{ $allergen->is_animal_product }}</td>
                    <td><a href="{{ route('admin.allergen.edit', $allergen) }}">edit</a></td>
                    @if (true || (Auth::user() && Auth::user()->is_super))
                        <td>
                            <form action="{{ route('admin.allergen.delete', $allergen) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="confirm" id="confirmation-input" />
                                <input type="submit" value="delete"
                                    onclick="return deleteConfirm('{{ $allergen->name }}')" />
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
</x-layout.admin>
