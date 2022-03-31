<x-layout.standard>
    @slot('title')
        login
    @endslot
    @section('content')
        <div class="hero">
            <h4 class="page-title">register</h4>

            <form action="{{ route('register.store') }}" method="post">
                @method('PUT')
                @csrf

                <div class="input-group">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="name">name</label>
                    <input type="text" name="name" id="name" autocomplete="name">
                </div>

                <div class="input-group">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="email">email</label>
                    <input type="text" name="email" id="email" autocomplete="email">
                </div>
                <div class="input-group">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="password">password</label>
                    <input type="password" name="password" id="password" autocomplete="password">
                </div>
                <button type="submit" class="btn main submit">register</button>
                <a class="not-focus-link" href="{{ route('login') }}">already got an account?</a>
            </form>
        </div>
    @endsection
</x-layout.standard>
