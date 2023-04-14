@props([
    'alert'
])

@php($alert_type = \App\Enums\AlertType::cases()[$alert['type']])

<div class="alert {{ $alert_type->style() }}
                mt-3 d-flex align-items-center justify-content-between">
    <div>{{ $alert['message']??"" }}</div>
    @if($alert['link'])
        <a href="{{ $alert['link'] }}" target="_blank" rel="noreferrer"
           class="btn btn-secondary btn-sm">{{ $alert['link_text']??__('Visit') }}</a>
    @endif
</div>
