<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <x-shared.favicon />
    <x-shared.head />
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <x-shared.navigation />
    <x-shared.admin-overlay />
    <main>
        @yield('content')
    </main>
    <x-shared.footer />
</body>
@yield('scripts')
<script>
    function logout() {
        document.getElementById('logout-form').submit();
    }

    function navigate(route) {
        window.location.href = route;
    }
</script>

</html>
