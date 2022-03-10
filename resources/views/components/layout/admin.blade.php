<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'admin - ' . config('app.name') }}</title>
    <script src="https://kit.fontawesome.com/d83d45983d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
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
        function navigate(route) {
            window.location.href = route;
        }
    </script>
</body>

</html>
