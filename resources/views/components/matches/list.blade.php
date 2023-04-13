<div class="rounds">
    @if($qualifiers)
        @include('components.matches.qualifiers')
    @else
        @include('components.matches.regular')
    @endif
</div>
