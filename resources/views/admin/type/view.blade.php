<x-layout.standard>
    @slot('title')
        {{ $type->name }}
    @endslot
    @section('content')
        <h1>{{ $type->name }}</h1>
        <hr>
        <div>
            <h4>Ingredients</h4>
            <table>
                <thead>
                    <th>NAME</th>
                </thead>
                <tbody>
                    @foreach ($type->ingredients as $ingredient)
                        <tr>
                            <td>{{ $ingredient->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
</x-layout.standard>
