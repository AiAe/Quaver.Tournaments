@props([
    'tournament',
    'match',
    'type',
    'name',
    'btn_class'
])

{{ Form::open(['url' => route('web.tournaments.rounds.match.update',
                                    ['tournament' => $tournament->slug,
                                    'round' => $match->tournament_stage_round_id,
                                    'match' => $match->id])]) }}
@method('PUT')

{{ Form::hidden("form_button_action", 1) }}
{{ Form::hidden($type, 1) }}
{{ Form::submit($name, ['class' => 'btn ' . $btn_class??"", 'style' => 'border-top-left-radius: 0; border-bottom-left-radius: 0;']) }}
{{ Form::close() }}
