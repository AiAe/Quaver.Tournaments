<a @class([
        'list-group-item',
        'active' => isset($route) && Route::is($route)
    ])
   href="{{isset($route) ? route($route, $routeParams) : '#'}}"
        {{ $attributes }}
>
    <i class="bi {{$icon}}"></i>
    {{$slot}}
</a>
