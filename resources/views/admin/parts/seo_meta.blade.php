@if(isset($seo['title']) && $seo['title'])
    <title>{{$seo['title']}} - {{ config('app.name') }}</title>
@else
    <title>{{config('app.name')}}</title>
@endif
<link href="{{ asset('/img/favicon.ico') }}" rel="shortcut icon">
<meta name="csrf-token" content="{{ csrf_token() }}">
