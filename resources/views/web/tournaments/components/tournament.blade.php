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
                        <div class="col-lg-6">
                            <div class="tournament-box">
                                <div class="tournament-box-title">{{ __('Dates') }}</div>
                                <div class="tournament-box-content">
                                    <div class="tournament-box-text">{{ __($tournament->status->name()) }}</div>
                                    @php($date_1 = \Carbon\Carbon::now()->days(77)->diffForHumans(['parts' => 2, 'short' => true]))
                                    @php($date_2 = \Carbon\Carbon::now()->days(77)->format('d.m.Y'))

                                    @if($tournament->status == TournamentStatus::RegistrationsOpen)
                                        <div>{{ __('Ends in :date', ['date' => $date_1]) }}</div>
                                    @elseif($tournament->status == TournamentStatus::Ongoing)
                                        <div>{{ __('Ends in :date', ['date' => $date_1]) }}</div>
                                    @elseif($tournament->status == TournamentStatus::Concluded)
                                        <div>{{ __('Ended :date', ['date' => $date_1]) }}</div>
                                    @else
                                        <div>{{ __('Starts in :date', ['date' => $date_1]) }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="tournament-box">
                                <div class="tournament-box-title">{{ __('Prize') }}</div>
                                <div class="tournament-box-content">
                                    <div class="tournament-box-text">
                                        {{ __('Total Prize Pool :total', ['total' => '600$']) }}
                                    </div>
                                    <div>
                                        {{ __('Top 3 Players Win a Cash Prize') }}
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <div class="col">
                            {{--                                    ToDo remove if no rank restriction--}}
                            <div class="tournament-box">
                                <div class="tournament-box-title">{{ __('Rank') }}</div>
                                <div class="tournament-box-content">
                                    <div class="tournament-box-text">Rank restricted</div>
                                    <div>#500 - #10,000</div>
                                </div>
                            </div>
                        </div>
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
