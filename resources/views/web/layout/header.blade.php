<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/img/logo.svg') }}" height="35px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('web.home') }}"><i class="bi bi-house"></i> {{ __('Home') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('web.tournaments.list') }}"><i class="bi bi-trophy"></i> {{ __('Tournaments') }}</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-md-auto">
                @auth()
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                            {{ __('Welcome, :username', ['username' => $loggedUser->username]) }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('web.auth.logout') }}">
                            <i class="bi bi-box-arrow-out-right"></i> {{ __('Logout') }}
                        </a>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('web.auth.oauth', 'quaver') }}">
                            <i class="bi bi-box-arrow-in-right"></i> {{ __('Login') }}
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
