<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: https://ogp.me/ns#">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @stack('seo')

    <meta name="keywords" content="Quaver, Tournament, QT, QOT, 1vs1, teams">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>

<body>

@include('web.layout.header')
<main>
    @yield('content')
</main>
@include('web.layout.footer')

@stack('scripts')
@stack('modals')

@auth()
    @if(empty($loggedUser->timezone_offset))
        @include('web.modals.timezone')
    @endif
@endauth

@include('web.layout.toast')
@livewireScripts

@if(config('clockwork.enable') === true)
    <script src="https://cdn.jsdelivr.net/gh/underground-works/clockwork-browser@1/dist/toolbar.js"></script>
@endif
</body>

</html>
