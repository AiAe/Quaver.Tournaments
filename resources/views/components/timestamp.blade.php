@props([
    'timestamp'
])

<span {{ $attributes }} class="badge bg-light text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $timestamp }} UTC">
    @if($loggedUser && $loggedUser->timezone_offset != null)
        {{ $loggedUser->convertTime($timestamp) }} (UTC{{ format_timezone_offset($loggedUser->timezone_offset) }})
    @else
        {{ $timestamp }}
    @endif
</span>

