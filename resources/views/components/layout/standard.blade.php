<!DOCTYPE html>
<html lang="en">

<head>
    <x-shared.favicon />
    <x-shared.head />
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <x-shared.navigation />
    <main>
        @yield('content')
    </main>
    <x-shared.footer />
</body>
@yield('scripts')

</html>
