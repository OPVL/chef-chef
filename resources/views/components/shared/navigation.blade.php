<nav>
    <div class="appname">
        <a href="{{ route('home') }}">{{ $appname }} <i class="fa-solid fa-hat-chef"></i></a>
    </div>
    <div class="authbox">
        @auth
            <a href="{{ route('home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
            <form action="{{ route('login.delete') }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit">logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

            @if ($showRegister)
                <a href="{{ route('register') }}"
                    class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
            @endif
        @endauth
    </div>
</nav>
