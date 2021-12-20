@if(isset($seo['title']) && $seo['title'])
    <title>{{$seo['title']}} - {{ config('app.name') }}</title>
@else
    <title>{{config('app.name')}}</title>
@endif
<link href="{{ asset('/img/favicon.ico') }}" rel="shortcut icon">
@if(isset($seo['title']) && $seo['title'])
    <meta property="og:title" content="{{ $seo['title'] }}">
    <meta name="twitter:title" content="{{ $seo['title'] }}"/>
@endif
<meta property="og:type" content="website"/>
<meta name="twitter:card" content="summary"/>
<meta name="description"
      content="If you're a 4K player looking to show off your skills, this tournament will be the perfect place to do so once again!">
<meta name="keywords" content="Quaver Tournament 4 Keys maps multiplayer 1v1">
<meta name="csrf-token" content="{{ csrf_token() }}">
