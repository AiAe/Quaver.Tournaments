<nav class="navbar navbar-expand-lg navbar-dark bg-qot">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">{{ __('Quaver Official Tournament') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav me-auto">
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{ routeIs('home') }}" href="{{ route('home') }}">{{ __('Home') }}</a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link {{ routeIs('signupPlayer') }}"
                       href="{{ route('signupPlayer') }}">{{ __('Join Tournament') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ routeIs('signupStaff') }}"
                       href="{{ route('signupStaff') }}">{{ __('Join Staff') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ routeIs('mapsSuggestion') }}"
                       href="{{ route('mapsSuggestion') }}">{{ __('Suggest maps') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ routeIs('rules') }}" href="{{ route('rules') }}">{{ __('Rules') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ routeIs('mappool') }}"
                       href="{{ route('mappool') }}">{{ __('Mappool') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ routeIs('players') }}"
                       href="{{ route('players') }}">{{ __('Players') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('Schedules') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://challonge.com/QOT2022" target="_blank">{{ __('Bracket') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ routeIs('staff') }}" href="{{ route('staff') }}">{{ __('Staff') }}</a>
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
                            @if($loggedUser['role'] === 100)
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">{{ __('Admin') }}</a>
                                <div class="dropdown-divider"></div>
                            @endif
                            @if(empty($loggedUser['discord_user_id']))
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
