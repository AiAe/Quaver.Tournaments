{{--<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">--}}
{{--    <div class="container-fluid">--}}
{{--        <a class="navbar-brand" href="#">--}}
{{--            <img src="{{ asset('assets/img/logo.svg') }}" height="30px">--}}
{{--        </a>--}}
{{--        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"--}}
{{--                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
{{--        <div class="collapse navbar-collapse" id="navbarNav">--}}
{{--            <ul class="navbar-nav">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-house"></i> {{ __('Home') }}</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="#"><i class="bi bi-trophy"></i> {{ __('Tournaments') }}</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--            <ul class="navbar-nav flex-row flex-wrap ms-md-auto">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-house"></i> {{ __('Home') }}</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="#"><i class="bi bi-trophy"></i> {{ __('Tournaments') }}</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}

<header class="navbar navbar-expand-lg navbar-dark bd-navbar sticky-top">
    <nav class="container-xxl bd-gutter flex-wrap flex-lg-nowrap" aria-label="Main navigation">
        <div class="bd-navbar-toggle">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bdNavbar"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <a class="navbar-brand p-0 me-0 me-lg-2" href="/" aria-label="QOT">
            <img src="{{ asset('assets/img/logo.svg') }}" height="30px">
        </a>

        <div class="d-flex">
            <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="offcanvas-lg offcanvas-end flex-grow-1 text-bg-dark" tabindex="-1" id="bdNavbar"
             aria-labelledby="bdNavbarOffcanvasLabel" data-bs-scroll="true">
            <div class="offcanvas-header px-4 pb-0">
                <h5 class="offcanvas-title text-white" id="bdNavbarOffcanvasLabel">Bootstrap</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"
                        data-bs-target="#bdNavbar"></button>
            </div>

            <div class="offcanvas-body p-4 pt-0 p-lg-0">
                <hr class="d-lg-none text-white-50">
                <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><i
                                class="bi bi-house"></i> {{ __('Home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-trophy"></i> {{ __('Tournaments') }}</a>
                    </li>
                </ul>

                <ul class="navbar-nav flex-row flex-wrap ms-md-auto">
                    <li class="nav-item">
                        <a class="nav-link py-2 px-0 px-lg-2" href="#">
                            Test
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>
