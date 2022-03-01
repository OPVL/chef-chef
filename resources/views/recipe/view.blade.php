<x-layout.standard>
    @slot('title')
        {{ $recipe->name }}
    @endslot
    @section('content')
        @foreach ($recipe->ingredients as $ingredient)
            <p>{{ $ingredient->name }} - {{ $ingredient->pivot->quantity }}{{ $ingredient->unit->label }}</p>
        @endforeach
    @endsection
</x-layout.standard>
