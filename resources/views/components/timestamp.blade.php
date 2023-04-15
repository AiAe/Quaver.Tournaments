@props([
    'timestamp'
])

{{-- TODO: tooltip --}}

<span {{ $attributes }} class="badge bg-light text-dark">
    @if($loggedUser && $loggedUser->timezone_offset != null)
        {{ $loggedUser->convertTime($timestamp) }} (local)
    @else
        {{ $timestamp }}
    @endif
</span>

