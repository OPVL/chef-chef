<x-layout.admin>
    @slot('title')
        recipes
    @endslot

    @section('content')
        @if (session()->has('success'))
            <div class="alert success">{{ session()->get('success') }}</div>
        @endif
        <div class="search-box">
            <h4>filter</h4>
            <div class="form-group">

                <div class="input-group">
                    <label for="filter-type">type</label>
                    <select name="filter-type" id="filter-type">
                        @foreach ($cuisines as $cuisine)
                            <option value="{{ $cuisine->id }}">{{ $cuisine->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group">
                    <label for="filter-name">name</label>
                    <input type="text" name="filter-name" id="filter-name" value="{{ old('filter-name') }}">
                </div>
            </div>
            <div class="extra">
                <div class="diet"></div>
                <div class="allergens"></div>
            </div>
        </div>
        <button onclick="navigate('{{ route('admin.recipe.create') }}')">new</button>
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
                            <form action="{{ route('admin.recipe.delete', $recipe) }}" method="post"
                                id="delete-{{ $recipe->name }}">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="confirm" id="confirmation-input-{{ $recipe->name }}">
                                <a href="javascript:deleteConfirm('{{ $recipe->name }}')">delete</a>
                                <input type="submit" value="delete"
                                    onclick="return deleteConfirm('{{ $recipe->name }}')">
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
    @endsection

    @section('scripts')
        <script>
            $('#filter-name').on('keyup', function() {
                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ route('ajax.ingredient') }}',
                    data: {
                        'query': $value
                    },
                    success: function(data) {
                        $('tbody').html(data);
                    }
                });
            })

            $('#filter-name').on('keyup', function() {
                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ route('ajax.ingredient') }}',
                    data: {
                        'query': $value
                    },
                    success: function(data) {
                        $('tbody').html(data);
                    }
                });
            })
        </script>
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
