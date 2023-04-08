<a
    @class([
        'list-group-item',
        'active' => isset($route) && Route::is($route)
    ])
    @if(isset($route))
        href="{{route($route, $routeParams)}}"
    @endif
    {{ $attributes }}
>
    <i class="bi {{$icon}}"></i>
    {{$slot}}
</a>
