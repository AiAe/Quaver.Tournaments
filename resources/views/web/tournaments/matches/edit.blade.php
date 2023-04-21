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

                <div class="form-group mb-2">
                    <label class="form-label">{{ __('Commentator 1') }}</label>
                    {{ Form::text('', $match_commentator1->user->username??'', ['class' => 'form-control', 'readonly' => 'readonly']) }}
                </div>

                <div class="form-group mb-2">
                    <label class="form-label">{{ __('Commentator 2') }}</label>
                    {{ Form::text('', $match_commentator2->user->username??'', ['class' => 'form-control', 'readonly' => 'readonly']) }}
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-2">
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
    </div>
@endsection
