<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: https://ogp.me/ns#">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('web.layout.seo_meta')
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>

@include('web.layout.header')
<main>
    @yield('content')
</main>
@include('web.layout.footer')

@stack('scripts')
@stack('modals')
@include('web.layout.toast')
@livewireScripts
</body>

</html>
