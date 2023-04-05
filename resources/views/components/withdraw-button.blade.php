@props([
    'team',
    'tournament'
])

@can('delete', $team)
    {{ Form::open([
        'url' => route('web.tournaments.teams.destroy', [$tournament, $team]),
        'onsubmit' => "return confirm('Do you really want to withdraw from the tournament?');"
    ]) }}
    @method('DELETE')
    {{ Form::submit(__('Withdraw'), ['class' => 'btn btn-danger btn-sm']) }}
    {{ Form::close() }}
@endcan
