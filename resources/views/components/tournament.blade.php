<div>
    <div class="tournament position-relative">
        <h1>{{ $tournament->name }}</h1>

        <div class="row">
            <div class="col-lg-12 col-md-12 d-flex align-items-center">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 tournament-cover">
                        <img src="{{ asset('assets/img/cover_l_q.png') }}" class="img-fluid"
                             width="610" height="150" loading="lazy">
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 d-flex align-items-center text-center">
                <div class="tournament-details">
                    <div class="row tournament-boxes">
                        <div class="col">
                            <div class="tournament-box">
                                <div class="tournament-box-title">{{ __('Dates') }}</div>
                                <div class="tournament-box-content">
                                    <div class="tournament-box-text">{{ __($tournament->status->name()) }}</div>
                                    @php($dates = $tournament->dates())
                                    @php($date = $dates->ends_at->diffForHumans(['parts' => 2]))

                                    @if($tournament->status == TournamentStatus::RegistrationsOpen)
                                        <div>{{ __('Ends in :date', ['date' => $date]) }}</div>
                                    @elseif($tournament->status == TournamentStatus::Ongoing)
                                        <div>{{ __('Ends in :date', ['date' => $date]) }}</div>
                                    @elseif($tournament->status == TournamentStatus::Concluded)
                                        <div>{{ __('Ended :date', ['date' => $date]) }}</div>
                                    @else
                                        <div>{{ __('Starts in :date', ['date' => $dates->starts_at->diffForHumans(['parts' => 2])]) }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @php($tournament_prize = $tournament->getMeta('prize'))
                        @php($prize_header = $tournament_prize['header']??null)
                        @php($prize_body = $tournament_prize['body']??null)
                        @if($prize_header || $prize_body)
                            <div class="col">
                                <div class="tournament-box">
                                    <div class="tournament-box-title">{{ __('Prize') }}</div>
                                    <div class="tournament-box-content">
                                        @if($prize_header)
                                            <div class="tournament-box-text">
                                                {{ $prize_header }}
                                            </div>
                                        @endif
                                        @if($prize_body)
                                            <div>
                                                {{ $prize_body }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row tournament-boxes">
                        <div class="col">
                            <div class="tournament-box">
                                <div class="tournament-box-title">{{ __('Format') }}</div>
                                <div class="tournament-box-content">
                                    <div class="tournament-box-text">{{ __($tournament->format->name()) }}</div>
                                    <div>
                                        @if($tournament->format == TournamentFormat::Solo)
                                            1 vs 1
                                        @else
                                            2 vs 2
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php($tournament_rank = $tournament->getMeta('rank'))
                        @php($rank_header = $tournament_rank['header']??null)
                        @php($rank_body = $tournament_rank['body']??null)
                        @if($rank_header || $rank_body)
                            <div class="col">
                                <div class="tournament-box">
                                    <div class="tournament-box-title">{{ __('Rank') }}</div>
                                    <div class="tournament-box-content">
                                        @if($rank_header)
                                            <div class="tournament-box-text">{{ $rank_header }}</div>
                                        @endif
                                        @if($rank_body)
                                            <div>{{ $rank_body }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col">
                            <div class="tournament-box">
                                <div class="tournament-box-title">{{ __('Entries') }}</div>
                                <div class="tournament-box-content">
                                    @if($tournament->format == TournamentFormat::Solo)
                                        <div class="tournament-box-text">
                                            {{ $tournament->participants()->count() }}
                                        </div>
                                        <div>{{ __('Players') }}</div>
                                    @else
                                        <div class="tournament-box-text">
                                            {{ $tournament->teams()->count() }}
                                        </div>
                                        <div>{{ __('Teams') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{route('web.tournaments.show', $tournament)}}"
                       class="stretched-link" title="{{ __('View Tournament') }}"></a>
                </div>
            </div>
        </div>
    </div>

</div>
