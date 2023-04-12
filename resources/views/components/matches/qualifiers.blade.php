@forelse($matches as $key => $timestamps)
    <div class="round-name d-flex align-items-center">
        <span></span> {{ \Carbon\Carbon::parse($key)->format('F j l') }}
    </div>

    @foreach($timestamps as $match)
        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10">
                        @php($participants = $match->ffaParticipants)
                        <div class="table-responsive">
                            <table class="table table-bordered table-dark mb-0">
                                <tr>
                                    @for($i = 0; $i < 5; $i++)
                                        <td>{{ $participants[$i]['name']??"Empty spot" }}</td>
                                    @endfor
                                </tr>
                                <tr>
                                    @for($i = 5; $i < 10; $i++)
                                        <td>{{ $participants[$i]['name']??"Empty spot" }}</td>
                                    @endfor
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="d-flex flex-column text-center gap-3">
                            <div
                                class="font-weight-bold text-primary">
                                {{ $match->timestamp->format('H:i \U\T\C') }}
                            </div>

                            @if($loggedUserTeamCaptain)
                            @php($player_in_stage_round = $loggedUserTeam->ffaMatches()
                                ->where('tournament_stage_round_id', $match->round->id)
                                ->first())
                                <livewire:tournaments.match-participant
                                    :match="$match" :player_in_stage_round="$player_in_stage_round"
                                    wire:key="match-{{ $match->id }}"></livewire:tournaments.match-participant>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@empty
    -
@endforelse
