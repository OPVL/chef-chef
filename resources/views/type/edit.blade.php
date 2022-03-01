<x-layout.standard>
    @slot('title')
        edit {{ $type->name }}
    @endslot
    @section('content')
        <form action="{{ route('type.update', $type) }}" method="post">
            @method('PATCH')
            @csrf
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="name">name</label>
            <input type="text" name="name" id="name" value="{{ $type->name }}">

            <button type="submit">update</button>
        </form>
    @endsection
</x-layout.standard>
