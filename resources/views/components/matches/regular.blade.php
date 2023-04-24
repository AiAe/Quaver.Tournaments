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
    <div class="table-responsive">
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
                    <td>
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
