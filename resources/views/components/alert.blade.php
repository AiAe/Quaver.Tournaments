@props([
    'classes',
    'message',
    'link',
    'link_text'
])

<div class="alert {{ $classes }} d-flex align-items-center justify-content-between">
    <div>{{ $message }}</div>
    @if($link)
        <a href="{{ $link }}" target="_blank" rel="noreferrer"
           class="btn btn-secondary btn-sm">{{ $link_text??__('Visit') }}</a>
    @endif
</div>
