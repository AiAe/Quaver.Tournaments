@if(isset($seo['title']) && $seo['title'])
    <title>{{$seo['title']}} - {{ config('app.name') }}</title>
@else
    <title>{{config('app.name')}}</title>
@endif
{{--<link href="{{\App\Utils\ImageUtils::getFavicon(128,128)}}" rel="shortcut icon">--}}
@if(isset($seo['title']) && $seo['title'])
    <meta property="og:title" content="{{ $seo['title'] }}">
    <meta name="twitter:title" content="{{ $seo['title'] }}"/>
@endif
@if(isset($seo['image']) && $seo['image'])
    <meta property="og:image" content="{{ $seo['image'] }}">
    <meta name="twitter:image:src" content="{{ $seo['image'] }}"/>
@endif
<meta property="og:type" content="website"/>
<meta name="twitter:card" content="summary"/>
@if(isset($seo['description']) && $seo['description'])
    <meta name="description" content="{{ $seo['description'] }}">
@endif
@if(isset($seo['keywords']) && $seo['keywords'])
    <meta name="keywords" content="{{ $seo['keywords'] }}">
@endif
<meta name="csrf-token" content="{{ csrf_token() }}">
