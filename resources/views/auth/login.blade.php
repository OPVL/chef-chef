<x-layout.standard>
    @slot('title')
        login
    @endslot
    @section('content')
        <div class="hero">
            <h4 class="page-title">login</h4>

            <form action="{{ route('login.store') }}" method="post">
                @method('PUT')
                @csrf

                <div class="input-group">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="email">email</label>
                    <input type="email" name="email" id="email" autocomplete="email" required
                        placeholder="{{ $emailPlaceholder }}">
                </div>

                <div class="input-group">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="password">password</label>
                    <input type="password" name="password" id="password" autocomplete="password" required
                        placeholder="{{ $passwordPlaceholder }}">
                </div>

                <button type="submit" class="btn main submit">login</button>

                <a class="not-focus-link" href="{{ route('forgot') }}">forgotten password?</a>
                <a class="not-focus-link" href="{{ route('register') }}">don't have an account?</a>
            </form>
        </div>
    @endsection
</x-layout.standard>
