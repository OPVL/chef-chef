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
                        <div class="alert danger">{{ $message }}</div>
                    @enderror
                    <label for="name">name</label>
                    <input type="text" name="name" id="name" value="{{ $allergen->name }}">
                </div>
                <div class="input-group">
                    @error('animal_product')
                        <div class="alert danger">{{ $message }}</div>
                    @enderror
                    <label for="animal_product">Animal Product</label>
                    <input type="checkbox" name="animal_product" id="animal_product"
                        {{ !$allergen->animal_product ?: 'checked' }}>
                </div>
            </div>
            <div class="action-buttons">
                <button type="submit" class="btn confirm">update</button>
                {{-- <form action="{{ route('admin.allergen.delete', $allergen) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="confirm" id="confirmation-input" />
                    <input type="submit" value="delete" onclick="return deleteConfirm('{{ $allergen->name }}')" />
                </form> --}}
                {{-- <input type="hidden" name="confirm" id="confirmation-input" />
                <button type="submit" class="btn error"
                    onclick="return deleteConfirm('{{ $allergen->name }}')">delete</button> --}}
            </div>
        </form>
    @endsection
    @section('scripts')
        <script>
            // function deleteConfirm(name) {
            //     const confirmation = confirm(`Are you sure you want to delete ${name}`);
            //     document.getElementById('confirmation-input').value = confirmation;
            //     return confirmation;
            // }
        </script>
    @endsection
</x-layout.admin>
