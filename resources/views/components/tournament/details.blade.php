@props([
    'tournament'
])

<div {{ $attributes->class(['tournament-details']) }}>
    <div class="row tournament-boxes">
        <div class="col">
            <div class="tournament-box">
                <div class="tournament-box-title">{{ __('Dates') }}</div>
                <div class="tournament-box-content">
                    <div class="tournament-box-text">{{ __($tournament->status->name()) }}</div>
                    @php
                        use App\Enums\TournamentStatus;
                        $displayDate = match ($tournament->status) {
                            TournamentStatus::Unlisted => $tournament->startsAt(),
                            TournamentStatus::RegistrationsOpen =>  $tournament->registrationEndsAt(),
                            default => $tournament->endsAt(),
                        };
                    @endphp

                    @if ($displayDate)
                        @php($data = ['date' => $displayDate->diffForHumans(['parts' => 2])])

                        @if($tournament->status == TournamentStatus::Unlisted)
                            <div>{{ __('Starts in :date', $data) }}</div>
                        @elseif($tournament->status == TournamentStatus::RegistrationsOpen)
                            <div>{{ __('Ends in :date', $data) }}</div>
                        @elseif($tournament->status == TournamentStatus::Ongoing)
                            <div>{{ __('Ends in :date', $data) }}</div>
                        @elseif($tournament->status == TournamentStatus::Concluded)
                            <div>{{ __('Ended :date', $data) }}</div>
                        @endif
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
</div>
