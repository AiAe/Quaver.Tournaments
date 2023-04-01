@if (isset($seo['title']) && $seo['title'])
    <title>{{ $seo['title'] }}</title>
@else
    <title>{{ config('app.name') }}</title>
@endif
<link href="{{ asset('assets/img/QT-Favicon-192x192.png') }}" rel="shortcut icon">
@if (isset($seo['title']) && $seo['title'])
    <meta property="og:title" content="{{ $seo['title'] }}">
    <meta name="twitter:title" content="{{ $seo['title'] }}" />
@endif
@if (isset($seo['description']) && $seo['description'])
    <meta name="og:description" content="{{ $seo['description'] }}" />
    <meta name="twitter:description" content="{{ $seo['description'] }}" />
    <meta name="description" content="{{ $seo['description'] }}">
@else
    <meta name="og:description"
          content="" />
    <meta name="twitter:description"
          content="" />
    <meta name="description"
          content="">
@endif
@if (isset($seo['image']) && $seo['image'])
    <meta property="og:image" content="{{ $seo['image'] }}">
    <meta property="twitter:image" content="{{ $seo['image'] }}">
@else
    <meta property="og:image" content="{{ asset('img/icon.png') }}">
    <meta property="twitter:image" content="{{ asset('img/icon.png') }}">
@endif
{{--<meta name="theme-color" content="">--}}
<meta property="og:type" content="website" />
<meta name="twitter:card" content="summary" />


{{--<meta name="author" content="">--}}
