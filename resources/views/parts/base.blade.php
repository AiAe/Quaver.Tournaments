<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('parts.seo_meta')

{{--    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css"/>--}}
</head>
<body>
@include('parts.header')
@yield('content')
@include('parts.footer')
@stack('scripts')
</body>
</html>
