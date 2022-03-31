<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <x-shared.favicon />
    <x-shared.head />
    <title>{{ $title ?? 'admin - ' . config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <x-admin.navigation />
    <header class="page-title">
        <h1>{{ $title ?? 'admin' }}</h1>
    </header>
    <main>
        @yield('content')
    </main>
    <x-admin.footer />
    @yield('scripts')
    <script>
        function logout() {
            document.getElementById('logout-form').submit();
        }

        function navigate(route) {
            window.location.href = route;
        }
    </script>
</body>

</html>
