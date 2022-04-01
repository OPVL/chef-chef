<x-layout.standard>
    @slot('title')
        create unit
    @endslot
    @section('content')
        <form action="{{ route('admin.unit.store') }}" method="post">
            @method('PUT')
            @csrf
            @error('name')
                <div class="alert danger">{{ $message }}</div>
            @enderror
            <label for="name">name</label>
            <input type="text" name="name" id="name">

            @error('label')
                <div class="alert danger">{{ $message }}</div>
            @enderror
            <label for="name">label</label>
            <input type="text" name="label" id="label">

            <button type="submit">save</button>
        </form>
    @endsection
</x-layout.standard>
