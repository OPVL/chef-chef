<x-layout.standard>
    @slot('title')
        register
    @endslot
    @section('content')
        <div class="hero">
            <h4 class="page-title">register</h4>

            <form action="{{ route('register.store') }}" method="post">
                @method('PUT')
                @csrf

                <div class="input-group">
                    @error('name')
                        <div class="alert danger">{{ $message }}</div>
                    @enderror
                    <label for="name">name</label>
                    <input type="text" name="name" id="name" autocomplete="name" required
                        placeholder="{{ $namePlaceholder }}" value="{{ old('name') }}">
                </div>

                <div class="input-group">
                    @error('email')
                        <div class="alert danger">{{ $message }}</div>
                    @enderror
                    <label for="email">email</label>
                    <input type="text" name="email" id="email" autocomplete="email" required
                        placeholder="{{ $emailPlaceholder }}" value="{{ old('email') }}">
                </div>
                <div class="input-group">
                    @error('password')
                        <div class="alert danger">{{ $message }}</div>
                    @enderror
                    <label for="password">password</label>
                    <input type="password" name="password" id="password" autocomplete="new-password" required
                        placeholder="{{ $passwordPlaceholder }}">
                </div>
                <div class="input-group">
                    @error('repeat_password')
                        <div class="alert danger">{{ $message }}</div>
                    @enderror
                    <label for="repeat_password">repeat password</label>
                    <input type="password" name="repeat_password" id="repeat_password" autocomplete="password" required
                        placeholder="{{ $passwordPlaceholder }}">
                </div>
                <x-debug.input type="checkbox" name="make_admin" :nonce="$nonce" />
                <button type="submit" class="btn main submit">register</button>
                <a class="not-focus-link" href="{{ route('login') }}">already got an account?</a>
            </form>
        </div>
    @endsection
</x-layout.standard>
