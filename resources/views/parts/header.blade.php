<nav class="navbar navbar-expand-lg navbar-dark bg-qot">
    <div class="container">
        <a class="navbar-brand" href="#">{{ __('Quaver Official Tournament') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">{{ __('Home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('Mappool') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('Players') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('Schedules') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('Team') }}</a>
                </li>
            </ul>

            @auth
                <ul class="navbar-nav ms-md-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                           aria-haspopup="true" aria-expanded="false">
                            <img src="{{ $loggedUser['quaver_avatar'] }}" alt="{{ $loggedUser['quaver_username'] }}"
                                 class="rounded" width="30" height="30">
                            {{ $loggedUser['quaver_username'] }}
                        </a>
                        <div class="dropdown-menu">
                            @if(!Auth::user()->discord_user_id)
                                <a class="dropdown-item" href="#">{{ __('Connect with Discord') }}</a>
                                <div class="dropdown-divider"></div>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}">{{ __('Logout') }}</a>
                        </div>
                    </li>
                </ul>
            @endauth

            @guest
                <ul class="navbar-nav ms-md-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('oauth', 'quaver') }}">{{ __('Login with Quaver') }}</a>
                    </li>
                </ul>
            @endguest
        </div>
    </div>
</nav>
