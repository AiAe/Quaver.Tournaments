<div class="container">
    <div class="page-navbar">
        <div class="d-flex page-navbar-shadow">
            <nav class="navbar navbar-expand-lg navbar-logo navbar-radius-left">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('web.home') }}" class="nav-link">
                            <img src="{{ asset('assets/img/logo.svg') }}" height="40px">
                        </a>
                    </li>
                </ul>
            </nav>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100 navbar-radius-right">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link {{ routeIs('web.home') }}" aria-current="page"
                                   href="{{ route('web.home') }}"><i
                                        class="bi bi-house"></i> {{ __('Home') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ routeIs('web.tournaments.index') }}"
                                   href="{{ route('web.tournaments.index') }}"><i
                                        class="bi bi-trophy"></i> {{ __('Tournaments') }}
                                </a>
                            </li>
                        </ul>

                        <ul class="navbar-nav ms-md-auto">
                            @auth()
                                <li class="nav-item dropdown">
                                    <a class="nav-link position-relative" href="#" role="button"
                                       data-bs-toggle="dropdown"
                                       aria-expanded="false">
                                        @if(count($loggedUser->unreadNotifications))
                                            <img src="{{ asset('assets/img/icons/app-indicator-red.svg') }}">
                                        @else
                                            <img src="{{ asset('assets/img/icons/app-indicator.svg') }}">
                                        @endif

                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end notifications">
                                        <div class="notifications-wrapper">
                                            @if(count($loggedUser->unreadNotifications))
                                                @foreach($loggedUser->unreadNotifications as $notification)
                                                    @livewire('user.notification', ['notification' => $notification], key($notification->id))
                                                @endforeach
                                            @else
                                                <div class="pt-2 pb-2 text-center">
                                                    {{ __('There is no new notifications') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                       aria-expanded="false">
                                        {{ __('Welcome, :username', ['username' => $loggedUser->username]) }}
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                {{ __('Profile') }}
                                            </a>
                                        </li>
                                        @can('create', \App\Models\Tournament::class)
                                            <div class="dropdown-divider"></div>
                                            <li>
                                                <a class="dropdown-item" href="#tournamentCreate" data-bs-toggle="modal"
                                                   data-bs-target="#tournamentCreate">
                                                    {{ __('Create Tournament') }}
                                                </a>
                                            </li>
                                            @push('modals')
                                                @livewire('tournaments.create', key('tournamentCreate'))
                                            @endpush
                                        @endcan

                                        @can('viewTelescope')
                                            <div class="dropdown-divider"></div>
                                            <li>
                                                <a class="dropdown-item" href="/telescope">
                                                    {{ __('Telescope Dashboard') }}
                                                </a>
                                            </li>
                                        @endcan

                                        <div class="dropdown-divider"></div>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('web.auth.logout') }}">
                                                {{ __('Logout') }}
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endauth
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web.auth.oauth', 'quaver') }}">
                                        <i class="bi bi-box-arrow-in-right"></i> {{ __('Login') }}
                                    </a>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

        </div>

    </div>

</div>
