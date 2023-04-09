@if($round->mappool_visible)
    @php($classes = "btn btn-danger btn-sm")
    @php($name = __('Hide'))
@else
    @php($classes = "btn btn-info btn-sm")
    @php($name = __('Publish'))
@endif
<button type="button" class="{{ $classes }}" wire:click="publish">{{ $name }}</button>

