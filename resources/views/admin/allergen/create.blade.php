<x-layout.admin>
    @slot('title')
        create allergen
    @endslot
    @section('content')
        <form class="crud-form" action="{{ route('admin.allergen.store') }}" method="post">
            @method('PUT')
            @csrf
            <div class="input-group">
                @error('name')
                    <div class="alert danger">{{ $message }}</div>
                @enderror
                <label for="name">name</label>
                <input type="text" name="name" id="allergen-name" placeholder="{{ $namePlaceholder }}"
                    value="{{ old('description') }}">
            </div>

            <button type="submit" class="btn main submit">save</button>
        </form>
    @endsection
</x-layout.admin>
