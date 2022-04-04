<x-layout.admin>
    @slot('title')
        {{ $recipe->name }}
    @endslot
    @section('content')
        @foreach ($recipe->ingredients as $ingredient)
            <p>{{ $ingredient->display }}</p>
        @endforeach
    @endsection
</x-layout.admin>
