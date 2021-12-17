<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('parts.seo_meta')
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css"/>
</head>
<body>
@include('parts.header')
@include('parts.alerts')
@yield('content')
@include('parts.footer')
<script src="{{ mix('js/app.js') }}" defer></script>
@stack('scripts')
</body>
</html>
