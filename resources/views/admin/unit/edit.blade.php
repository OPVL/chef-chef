<x-layout.standard>
    @slot('title')
        edit {{ $unit->name }}
    @endslot
    @section('content')
        <form action="{{ route('unit.update', $unit) }}" method="post">
            @method('PATCH')
            @csrf
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="name">name</label>
            <input type="text" name="name" id="unit-name" value="{{ $unit->name }}">

            @error('label')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="name">label</label>
            <input type="text" name="label" id="unit-label" value="{{ $unit->label }}">

            <button type="submit">update</button>
        </form>
    @endsection
</x-layout.standard>
