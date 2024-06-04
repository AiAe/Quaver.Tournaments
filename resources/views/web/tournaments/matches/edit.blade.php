@extends('web.tournaments.parts.base')

@push('seo')
    {!! seo()->for($tournament) !!}
@endpush

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>{{ $title }}</h1>
        </header>
    </div>
@endpush

@section('section')
    @php($match_staff = collect($match->staff()->with(['user'])->get()))
    @php($match_referee = $match_staff->where('role', \App\Enums\StaffRole::Referee)->first())
    @php($match_streamer = $match_staff->where('role', \App\Enums\StaffRole::Streamer)->first())
    @php($match_commentator1 = $match_staff->where('role', \App\Enums\StaffRole::Commentator)->first()??null)
    @php($match_commentator2 = $match_staff->where('role', \App\Enums\StaffRole::Commentator)->where('user_id', '!=', $match_commentator1?->user_id)->first()??null)

    @can('delete', $match)
        <div class="d-flex justify-content-end mb-2">
            {{ Form::open(['url' => route('web.tournaments.rounds.match.destroy', ['tournament' => $tournament->slug,
                                    'round' => $match->tournament_stage_round_id,
                                    'match' => $match->id])]) }}
            @method('DELETE')
            {{ Form::submit(__('Delete lobby'), ['class' => 'btn btn-danger btn-sm']) }}
            {{ Form::close() }}
        </div>
    @endcan

    @if($loggedUserCan['referee'])
        <div class="card mb-2">
            <div class="card-header">{{ __('Multiplayer Links') }}</div>
            <div class="card-body">
                <div class="alert alert-info">
                    {{ __('Please submit the lobby multiplayer link here. ') }}<br>
                    {{ __('In case lobby had to get divided into more than one lobby, submit both links below (one at a time).') }}
                </div>

                {{ Form::open(['url' => route('web.tournaments.rounds.match.update',
                                        ['tournament' => $tournament->slug,
                                        'round' => $match->tournament_stage_round_id,
                                        'match' => $match->id])]) }}
                @method('PUT')
                <label class="form-label">{{ __('URL') }}</label>
                <div class="input-group">
                    {{ Form::text('mp_link', null, ['class' => 'form-control']) }}
                    <div class="input-group-append">
                        {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary', 'style' => 'border-top-left-radius: 0; border-bottom-left-radius: 0;']) }}
                    </div>
                </div>
                {{ Form::close() }}
                @if($match->quaver_mp_ids)
                    @foreach($match->quaver_mp_ids as $mp_link)
                        <a href="{{ $match->mp_link($mp_link) }}"
                           target="_blank" class="d-block">{{ $match->mp_link($mp_link) }}</a>
                    @endforeach
                @endif
            </div>
        </div>
    @endif

    @if($loggedUserCan['organizer'] || $loggedUserCan['head_referee'])
        <div class="card mb-2">
            <div class="card-header">{{ __('Match Schedule') }}</div>
            <div class="card-body">
                {{ Form::open(['url' => route('web.tournaments.rounds.match.update',
                                        ['tournament' => $tournament->slug,
                                        'round' => $match->tournament_stage_round_id,
                                        'match' => $match->id])]) }}
                @method('PUT')
                <label class="form-label">{{ __('Timestamp UTC-0') }}</label>
                <div class="input-group">
                    {{ Form::text('timestamp', $match->timestamp, ['class' => 'form-control']) }}
                    <div class="input-group-append">
                        {{ Form::submit(__('Update'), ['class' => 'btn btn-primary', 'style' => 'border-top-left-radius: 0; border-bottom-left-radius: 0;']) }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header">{{ __('Assign staff') }}</div>
        <div class="card-body">
            @if($loggedUserCan['organizer'] || $loggedUserCan['head_referee'] || $loggedUserCan['head_streamer'])
                {{ Form::open(['url' => route('web.tournaments.rounds.match.update',
                                    ['tournament' => $tournament->slug,
                                    'round' => $match->tournament_stage_round_id,
                                    'match' => $match->id])]) }}
                @method('PUT')
                <div>
                    @if($loggedUserCan['organizer'] || $loggedUserCan['head_referee'])
                        <div class="form-group mb-2">
                            <label class="form-label">{{ __('Referee') }}</label>
                            {{ Form::select('referee_id', tournament_staff_role($tournament->id, \App\Enums\StaffRole::Referee, true), $match_referee->user_id??'', ['class' => 'form-control']) }}
                        </div>
                    @endif

                    @if($loggedUserCan['organizer'] || $loggedUserCan['head_streamer'])
                        <div class="form-group mb-2">
                            <label class="form-label">{{ __('Streamer') }}</label>
                            {{ Form::select('streamer_id', tournament_staff_role($tournament->id, \App\Enums\StaffRole::Streamer, true), $match_streamer->user_id??'', ['class' => 'form-control']) }}
                        </div>

                        @php($commentators = tournament_staff_role($tournament->id, \App\Enums\StaffRole::Commentator, true))

                        <div class="form-group mb-2">
                            <label class="form-label">{{ __('Commentator 1') }}</label>
                            {{ Form::select('commentators[]', $commentators, $match_commentator1->user_id??'', ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group mb-2">
                            <label class="form-label">{{ __('Commentator 2') }}</label>
                            {{ Form::select('commentators[]', $commentators, $match_commentator2->user_id??'', ['class' => 'form-control']) }}
                        </div>
                    @endif
                </div>

                {{ Form::submit(__('Save'), ['class' => 'btn btn-primary btn-sm mt-2']) }}
                {{ Form::close() }}

                <hr>
            @endif

            <div>
                <div class="mb-2">
                    <label class="form-label">{{ __('Referee') }}</label>
                    <div class="input-group">
                        {{ Form::text('', $match_referee->user->username??'', ['class' => 'form-control', 'readonly' => 'readonly']) }}
                        @if($loggedUserCan['referee'])
                            <div class="input-group-append">
                                @if(!$match_referee)
                                    <x-matches.actions.assign :tournament="$tournament" :match="$match"
                                                              type="referee_take" :name="__('Take')"
                                                              btn_class="btn-primary">
                                    </x-matches.actions.assign>
                                @elseif($match_referee->user_id == $loggedUser->id)
                                    <x-matches.actions.assign :tournament="$tournament" :match="$match"
                                                              type="referee_resign" :name="__('Resign')"
                                                              btn_class="btn-danger">
                                    </x-matches.actions.assign>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label">{{ __('Streamer') }}</label>
                    <div class="input-group">
                        {{ Form::text('', $match_streamer->user->username??'', ['class' => 'form-control', 'readonly' => 'readonly']) }}
                        @if($loggedUserCan['streamer'])
                            <div class="input-group-append">
                                @if(!$match_streamer)
                                    <x-matches.actions.assign :tournament="$tournament" :match="$match"
                                                              type="streamer_take" :name="__('Take')"
                                                              btn_class="btn-primary">
                                    </x-matches.actions.assign>
                                @elseif($match_streamer->user_id == $loggedUser->id)
                                    <x-matches.actions.assign :tournament="$tournament" :match="$match"
                                                              type="streamer_resign" :name="__('Resign')"
                                                              btn_class="btn-danger">
                                    </x-matches.actions.assign>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label">{{ __('Commentator 1') }}</label>
                    <div class="input-group">
                        {{ Form::text('', $match_commentator1->user->username??'', ['class' => 'form-control', 'readonly' => 'readonly']) }}

                        @if($loggedUserCan['commentator'])
                            @if(!$match_commentator1)
                                <x-matches.actions.assign :tournament="$tournament" :match="$match"
                                                          type="commentator_take" :name="__('Take')"
                                                          btn_class="btn-primary">
                                </x-matches.actions.assign>
                            @elseif($match_commentator1->user_id == $loggedUser->id)
                                <x-matches.actions.assign :tournament="$tournament" :match="$match"
                                                          type="commentator_resign" :name="__('Resign')"
                                                          btn_class="btn-danger">
                                </x-matches.actions.assign>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label">{{ __('Commentator 2') }}</label>
                    <div class="input-group">
                        {{ Form::text('', $match_commentator2->user->username??'', ['class' => 'form-control', 'readonly' => 'readonly']) }}

                        @if($loggedUserCan['commentator'])
                            @if(!$match_commentator2)
                                <x-matches.actions.assign :tournament="$tournament" :match="$match"
                                                          type="commentator_take" :name="__('Take')"
                                                          btn_class="btn-primary">
                                </x-matches.actions.assign>
                            @elseif($match_commentator2->user_id == $loggedUser->id)
                                <x-matches.actions.assign :tournament="$tournament" :match="$match"
                                                          type="commentator_resign" :name="__('Resign')"
                                                          btn_class="btn-danger">
                                </x-matches.actions.assign>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-2">
        @if($match->round->stage->stage_format == \App\Enums\TournamentStageFormat::Qualifier)
            <table class="table table-dark">
                <thead>
                <tr>
                    <th style="width: 25%;">{{ __('Player') }}</th>
                    <th style="width: 25%;">{{ __('Discord ID') }}</th>
                    <th style="width: 25%;">{{ __('Timezone Offset') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($match->ffaParticipants as $participant)
                    @php($captain = $participant->captain())
                    <tr>
                        <td>
                            {{ $captain->username }}
                        </td>
                        <td>
                            {{ $captain->discord_user_id }}
                        </td>
                        <td>
                            {{ $captain->timezone_offset }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        @if($match->round->stage->stage_format == \App\Enums\TournamentStageFormat::Swiss)
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th style="width: 10%;">{{ __('Lobby')  }}</th>
                        <th style="width: 25%" class="text-center">{{ __('Team 1')  }}</th>
                        <th style="width: 5%" class="text-center">{{ __('')  }}</th>
                        <th style="width: 5%" class="text-center">{{ __('')  }}</th>
                        <th style="width: 25%" class="text-center">{{ __('Team 2')  }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div>{{ $match->label }}</div>
                            <x-timestamp :timestamp="$match->timestamp" :has_title="false"/>
                        </td>
                        <td class="text-center team-name">
                            {{ Str::limit($match->team1?->name??"-", 15) }}
                            <br>
                            {{ $match->team1?->captain()->discord_user_id }}
                        </td>
                        <td class="text-center">{{ $match->score1??"-" }}</td>
                        <td class="text-center">{{ $match->score2??"-" }}</td>
                        <td class="text-center  team-name">
                            {{ Str::limit($match->team2?->name??"-", 15) }}
                            <br>
                            {{ $match->team2?->captain()->discord_user_id }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
