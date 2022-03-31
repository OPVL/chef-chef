<x-layout.standard>
    @slot('title')
        login
    @endslot
    @section('content')
        <form action="{{ route('login.store') }}" method="post">
            @method('PUT')
            @csrf

            <label for="email">email</label>
            <input type="text" name="email" id="email" autocomplete="email">

            <label for="password">password</label>
            <input type="password" name="password" id="password" autocomplete="password">

            <button type="submit">login</button>
        </form>
    @endsection
</x-layout.standard>
