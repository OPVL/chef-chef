@if ($display)
    <div id="admin-overlay">
        <ul class="horizontal-list">
            <li><a href="{{ route('admin.index') }}"><i class="fa-solid fa-hand-middle-finger"></i>admin</a></li>
            <li><a href="{{ route('admin.user.index') }}"><i class="fa-solid fa-user-gear"></i>manage users</a>
            </li>
            <li><a href="{{ route('admin.setting.index') }}"><i class="fa-solid fa-gears"></i>settings</a></li>
            <li>
                <a href="javascript:logout()">
                    <form action="{{ route('login.delete') }}" method="post" id="logout-form" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                    <i class="fa-solid fa-right-from-bracket"></i>
                    logout
                </a>
            </li>
        </ul>
    </div>
@endif
