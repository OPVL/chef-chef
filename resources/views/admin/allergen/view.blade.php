<x-layout.standard>
    @slot('title')
        {{ $allergen->name }}
    @endslot
    @section('content')
        <h1>{{ $allergen->name }}</h1>
        <hr>
        <div>
            <h4>Ingredients</h4>
            <table>
                <thead>
                    <th>NAME</th>
                </thead>
                <tbody>
                    @foreach ($allergen->ingredients as $ingredient)
                        <tr>
                            <td>{{ $ingredient->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
</x-layout.standard>
