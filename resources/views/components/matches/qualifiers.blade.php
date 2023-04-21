@php use Carbon\Carbon; use App\Enums\StaffRole @endphp
@forelse($matches as $date => $timestamps)
    @php($parsed_date = Carbon::parse($date))
    <div class="round-name d-flex align-items-center">
        <span></span>{{ $parsed_date->format('F j l') }}
    </div>

    @foreach($timestamps as $match)
        @php($match_staff = collect($match->staff))
        @php($match_referee = $match_staff->where('role', StaffRole::Referee)->first())
        @php($match_streamer = $match_staff->where('role', StaffRole::Streamer)->first())
        @php($match_commentator1 = $match_staff->where('role', \App\Enums\StaffRole::Commentator)->first()??null)
        @php($match_commentator2 = $match_staff->where('role', \App\Enums\StaffRole::Commentator)->where('user_id', '!=', $match_commentator1?->user_id)->first()??null)

        <div class="card mb-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <h5 class="m-0 p-0">{{ __('Lobby') }} {{ $match->label }}</h5>
                        <p class="m-0 p-0">
                            <x-timestamp :timestamp="$match->timestamp"/>
                        </p>
                    </div>

                    <div class="col-lg-4">
                        <div>
                            {{ __('Referee') }}: {{ $match_referee->user->username??"-" }}
                        </div>
                        <div>
                            {{ __('Streamer') }}: {{ $match_streamer->user->username??"-" }}
                        </div>
                        <div>
                            {{ __('Commentators') }}: {{ $match_commentator1->user->username??"-" }}
                            / {{ $match_commentator2->user->username??"-" }}
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="d-flex flex-column gap-1 align-items-center">
                            @if($loggedUserTeamCaptain)
                                <livewire:tournaments.match-participant
                                    class="d-flex justify-content-end mt-2"
                                    :match="$match"
                                    wire:key="match-{{ $match->id }}"></livewire:tournaments.match-participant>
                            @endif
                            @can('editStaff', $match)
                                <a class="btn btn-warning btn-sm" href="{{ route('web.tournaments.rounds.match.edit',
                                    ['tournament' => $tournament->slug, 'round' => $match->tournament_stage_round_id, 'match' => $match->id]) }}">
                                    {{ __('Manage Lobby') }}
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    @php($participants = $match->ffaParticipants)
                    <div class="table-responsive">
                        <table class="table table-bordered table-dark mb-0">
                            <tr>
                                @for($i = 0; $i < 5; $i++)
                                    <td style="width: 20%;">{{ $participants[$i]['name'] ?? "-" }}</td>
                                @endfor
                            </tr>
                            <tr>
                                @for($i = 5; $i < 10; $i++)
                                    <td style="width: 20%;">{{ $participants[$i]['name'] ?? "-" }}</td>
                                @endfor
                            </tr>
                            <tr>
                                @for($i = 10; $i < 15; $i++)
                                    <td style="width: 20%;">{{ $participants[$i]['name'] ?? "-" }}</td>
                                @endfor
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@empty
    <div class="card mb-2">
        <div class="card-body">
            <div class="row">
                <span>{{__('No matches so far...')}}</span>
            </div>
        </div>
    </div>
@endforelse
