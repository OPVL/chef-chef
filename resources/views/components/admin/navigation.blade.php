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
