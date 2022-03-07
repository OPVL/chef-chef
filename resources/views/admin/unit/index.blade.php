<x-layout.standard>
    @slot('title')
        units
    @endslot
    @section('content')
        @if(session()->has('success'))
            {{ session()->get('success') }}
        @endif
        <table>
            <thead>
                <th>ID</th>
                <th>NAME</th>
                <th>LABEL</th>
                <th>EDIT</th>
            </thead>
            @foreach ($units as $unit)
                <tr>
                    <td>{{ $unit->id }}</td>
                    <td>{{ $unit->name }}</td>
                    <td>{{ $unit->label }}</td>
                    <td><a href="{{ route('admin.unit.edit', $unit) }}">edit</a></td>
                </tr>
            @endforeach
        </table>
    @endsection
</x-layout.standard>
