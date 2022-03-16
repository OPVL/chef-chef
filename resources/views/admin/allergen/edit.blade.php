<x-layout.admin>
    @slot('title')
        edit {{ $allergen->name }}
    @endslot
    @section('content')
        <form action="{{ route('admin.allergen.update', $allergen) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="admin-form">
                <div class="input-group">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="name">name</label>
                    <input type="text" name="name" id="name" value="{{ $allergen->name }}">
                </div>
                <div class="input-group">
                    @error('is_animal_product')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="is_animal_product">Animal Product</label>
                    <input type="checkbox" name="is_animal_product" id="is_animal_product"
                        {{ !$allergen->is_animal_product ?: 'checked' }}>
                </div>
            </div>
        </form>
        <div class="action-buttons">
            <button class="btn confirm">update</button>
            {{-- <form action="{{ route('admin.allergen.delete', $allergen) }}" method="post">
                @method('DELETE')
                @csrf
                <input type="hidden" name="confirm" id="confirmation-input" />
                <input type="submit" value="delete" onclick="return deleteConfirm('{{ $allergen->name }}')" />
            </form> --}}
            <button class="btn error">delete</button>
        </div>
    @endsection
    @section('scripts')
        <script>
            function deleteConfirm(name) {
                const confirmation = confirm(`Are you sure you want to delete ${name}`);
                document.getElementById('confirmation-input').value = confirmation;
                return confirmation;
            }
        </script>
    @endsection
</x-layout.admin>
