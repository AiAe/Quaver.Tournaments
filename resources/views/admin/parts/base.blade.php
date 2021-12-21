<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('admin.parts.seo_meta')
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css"/>
</head>
<body>
@include('admin.parts.header')
@include('admin.parts.cover')
@include('admin.parts.alerts')
@yield('content')
@include('admin.parts.footer')
<script src="{{ mix('js/app.js') }}" defer></script>
@stack('scripts')
</body>
</html>
