@php use Carbon\Carbon; use App\Enums\StaffRole @endphp

@push('styles')
    <style>
        table tr td {
            vertical-align: middle;
        }

        table tr.staff {
            border-bottom: 2px solid #5A5A5A;
            font-size: 14px;
        }

        table tr .team-name {
            font-weight: bold;
        }
    </style>
@endpush

@forelse($matches as $key => $timestamps)
    <div class="round-name d-flex align-items-center">
        <span></span> {{ \Carbon\Carbon::parse($key)->format('F j l') }}
    </div>
    <div>
        @foreach($timestamps as $match)
            @php($match_staff = collect($match->staff))
            @php($match_referee = $match_staff->where('role', StaffRole::Referee)->first())
            @php($match_streamer = $match_staff->where('role', StaffRole::Streamer)->first())
            @php($match_commentator1 = $match_staff->where('role', StaffRole::Commentator)->first()??null)
            @php($match_commentator2 = $match_staff->where('role', StaffRole::Commentator)->where('user_id', '!=', $match_commentator1?->user_id)->first()??null)

            <div class="card mb-2">
                <div class="row">
                    <div class="col-lg-3 round-match-border order-lg-0 order-md-0 order-1">
                        <div class="d-flex h-100 flex-column align-items-start justify-content-center p-2 round-match-staff">
                            <div><strong>{{ __('Referee') }}</strong>: {{ $match_referee->user->username??"-" }}</div>
                            <div>
                                <div><strong>{{ __('Streamer') }}</strong>: {{ $match_streamer->user->username??"-" }}
                                </div>
                                <div><strong>{{ __('Caster') }}</strong>: {{ $match_commentator1->user->username??"-" }}
                                </div>
                                <div><strong>{{ __('Caster') }}</strong>: {{ $match_commentator2->user->username??"-" }}
                                </div>
                            </div>

                            @can('editStaff', $match)
                                <div class="mt-3">
                                    <a class="btn btn-warning btn-sm" href="{{ route('web.tournaments.rounds.match.edit',
                                                            ['tournament' => $tournament->slug, 'round' => $match->tournament_stage_round_id, 'match' => $match->id]) }}">
                                        {{ __('Manage') }}
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="col-lg-9 order-lg-1 order-md-1 order-0">
                        <div class="round-match">
                            <div class="round-match-team-left">
                                {{ Str::limit($match->team1?->name??"-", 15) }}
                                <div class="round-match-team-right-mobile">
                                    vs. {{ Str::limit($match->team2?->name??"-", 15) }}
                                </div>
                            </div>
                            <div class="round-match-team-status">
                                <div>
                                    {{ $match->label }} - {{ $match->timestamp->format('H:i') }}
                                    <div>
                                        <x-timestamp :timestamp="$match->timestamp" :has_title="false"/>
                                    </div>
                                </div>
                                <div class="mt-2">{{ __('Score') }}</div>
                                @if($match->score1 || $match->score2)
                                    <div class="badge text-bg-success badge-result">
                                        {{ $match->score1??"-" }} : {{ $match->score2??"-" }}
                                    </div>
                                @else
                                    <div class="badge text-bg-secondary badge-result">
                                        {{ $match->score1??"-" }} : {{ $match->score2??"-" }}
                                    </div>
                                @endif
                            </div>
                            <div class="round-match-team-right">
                                {{ Str::limit($match->team2?->name??"-", 15) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="table-responsive d-none">
        <table class="table table-dark">
            <thead>
            <tr>
                <th style="width: 10%;">{{ __('Lobby')  }}</th>
                <th style="width: 15%" class="text-center">{{ __('Team 1')  }}</th>
                <th style="width: 5%" class="text-center">{{ __('')  }}</th>
                <th style="width: 5%" class="text-center">{{ __('')  }}</th>
                <th style="width: 15%" class="text-center">{{ __('Team 2')  }}</th>
                <th style="width: 5%" class="text-center">{{ __('')  }}</th>
            </tr>
            </thead>
            @foreach($timestamps as $match)
                @php($match_staff = collect($match->staff))
                @php($match_referee = $match_staff->where('role', StaffRole::Referee)->first())
                @php($match_streamer = $match_staff->where('role', StaffRole::Streamer)->first())
                @php($match_commentator1 = $match_staff->where('role', StaffRole::Commentator)->first()??null)
                @php($match_commentator2 = $match_staff->where('role', StaffRole::Commentator)->where('user_id', '!=', $match_commentator1?->user_id)->first()??null)

                <tr>
                    <td>
                        <div>{{ $match->label }}</div>
                        <x-timestamp :timestamp="$match->timestamp" :has_title="false"/>
                    </td>
                    <td class="text-center team-name">
                        {{ Str::limit($match->team1?->name??"-", 15) }}
                    </td>
                    <td class="text-center">{{ $match->score1??"-" }}</td>
                    <td class="text-center">{{ $match->score2??"-" }}</td>
                    <td class="text-center  team-name">{{ Str::limit($match->team2?->name??"-", 15) }}</td>
                    <td class="text-center">
                        {{--                        @can('editTimestamp', $match)--}}
                        {{--                            <a href="{{ route('web.tournaments.rounds.match.reschedule.edit', ['tournament' => $tournament->slug, 'round' => $match->tournament_stage_round_id, 'match' => $match->id]) }}"--}}
                        {{--                               class="btn btn-info btn-sm mb-1">{{ __('Reschedule') }}</a>--}}
                        {{--                        @endcan--}}
                        @can('editStaff', $match)
                            <a class="btn btn-warning btn-sm" href="{{ route('web.tournaments.rounds.match.edit',
                                                            ['tournament' => $tournament->slug, 'round' => $match->tournament_stage_round_id, 'match' => $match->id]) }}">
                                {{ __('Manage') }}
                            </a>
                        @endcan
                    </td>
                </tr>

                <tr class="staff">
                    <td>{{ __('Referee') }}: {{ $match_referee->user->username??"-" }}</td>
                    <td colspan="2">{{ __('Streamer') }}: {{ $match_streamer->user->username??"-" }}</td>
                    <td colspan="3">
                        {{ __('Commentators') }}: {{ $match_commentator1->user->username??"-" }}
                        / {{ $match_commentator2->user->username??"-" }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@empty
    <div class="card">
        <div class="card-body">
            {{ __('There are currently no matches') }}
        </div>
    </div>
@endforelse
