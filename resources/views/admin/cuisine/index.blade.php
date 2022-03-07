<x-layout.standard>
    @slot('title')
        cuisines
    @endslot

    @section('content')
        <table>
            <thead>
                <th>ID</th>
                <th>NAME</th>
                <th>DESCRIPTION</th>
            </thead>
            @foreach ($cuisines as $cuisine)
                <tr>
                    <td>{{ $cuisine->id }}</td>
                    <td>{{ $cuisine->name }}</td>
                    <td>{{ $cuisine->description }}</td>
                </tr>
            @endforeach
        </table>
    @endsection
</x-layout.standard>
