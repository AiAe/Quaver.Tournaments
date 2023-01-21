<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: https://ogp.me/ns#">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('web.layout.seo_meta')
    @vite(['resources/css/app.css'])
</head>

<body>
@include('web.layout.header')
@yield('content')
@include('web.layout.footer')
@vite(['resources/js/app.js'])
@stack('scripts')
</body>

</html>
