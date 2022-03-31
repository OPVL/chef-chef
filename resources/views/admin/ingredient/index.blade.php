<x-layout.admin>
    @slot('title')
        ingredients
    @endslot

    @section('content')
        @if (session()->has('success'))
            {{ session()->get('success') }}
        @endif
        <form class="search-box" action="{{ route('admin.ingredient.index') }}" method="GET">
            <h4>filter</h4>
            <div class="filter-group">
                <label for="filter-type">type</label>
                <select name="filter-type" id="filter-type">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ old('filter-type') == $type->id ? 'selected' : null }}>{{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="filter-name">name</label>
                <input type="text" name="filter-name" id="filter-name" value="{{ old('filter-name') }}">
            </div>
            <div class="extra">
                <div class="diet"></div>
                <div class="allergens"></div>
            </div>
        </form>
        <table>
            <thead>
                <th>ID</th>
                <th>NAME</th>
                <th>UNIT</th>
                <th>TYPE</th>
                <th>EDIT</th>
                {{-- @if (true || (Auth::user() && Auth::user()->is_super))
                    <th>DELETE</th>
                @endif --}}
            </thead>
            <tbody>
                @foreach ($ingredients as $ingredient)
                    <tr>
                        <td>{{ $ingredient->id }}</td>
                        <td>{{ $ingredient->name }}</td>
                        <td>{{ $ingredient->unit->name }}</td>
                        <td>{{ $ingredient->type->name }}</td>
                        <td><a href="{{ route('admin.ingredient.edit', $ingredient) }}">edit</a></td>
                        @if (true || (Auth::user() && Auth::user()->is_super))
                            <td>
                                <form action="{{ route('admin.ingredient.delete', $ingredient) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="confirm" id="confirmation-input">
                                    <input type="submit" value="delete">
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- return deleteConfirm('{{ $ingredient->name }}') --}}
    @endsection
    @section('scripts')

        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'csrftoken': '{{ csrf_token() }}'
                }
            });
        </script>
    @endsection
</x-layout.admin>
