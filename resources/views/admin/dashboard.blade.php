<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>admin</title>
    <script src="https://kit.fontawesome.com/d83d45983d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <nav>
        <div class="sitename">
            {{-- <div class="icon">
                <img src="{{ asset('img/chefhat.png') }}" alt="chef hat">
            </div> --}}
            <div class="name">
                {{ config('app.name') }}
            </div>
        </div>
        <div class="authbox">
            <div class="icon"><i class="fa-solid fa-peace"></i></div>
            <div class="options hidden">
                <ul>
                    @auth
                        <li><a href="{{ route('home') }}">manage account</a></li>
                        <li>
                            <form action="{{ route('login.delete') }}" method="post" id="logout-form">
                                @csrf
                                @method('DELETE')
                                <a href="javascript:logout()">logout</a>
                        </li>
                        </form>
                    @else
                        <li><a href="{{ route('login') }}">login</a></li>
                        <li><a href="{{ route('register') }}">register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    {{-- <div class="breadcrumbs"></div> --}}

    <main>
        <div class="page-title">Admin</div>
        <div class="module-boxes">
            @foreach ($modules as $module)
                <button class="module" onclick="navigate('{{ $module['route'] }}')">
                    <div class="icon">
                        {!! $module['icon'] !!}
                    </div>
                    <div class="name">{{ $module['name'] }}</div>
                </button>
            @endforeach
        </div>
    </main>
</body>
<script>
    function logout() {
        document.getElementById('logout-form').submit();
    }

    function navigate(route) {
        window.location.href = route;
    }
</script>

</html>
