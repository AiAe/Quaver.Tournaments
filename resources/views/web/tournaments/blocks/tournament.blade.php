<div class="tournament">
    <h1>{{ $tournament->name }}</h1>

    <div class="row">
        <div class="col-lg-7 col-md-7 d-flex align-items-center">
            <img src="https://dummyimage.com/800x200/c1c1c1/ffffff.jpg" class="img-fluid">
        </div>
        <div class="col-lg-5 col-md-5 d-flex align-items-center text-center">
            <div class="tournament-details">
                <div class="row tournament-boxes">
                    <div class="col-lg-6">
                        <div class="tournament-box">
                            <div class="tournament-box-title">{{ __('Dates') }}</div>
                            <div class="tournament-box-content">
                                <div class="tournament-box-text">{{ __('Starts in :time', ['time' => \Carbon\Carbon::now()->addDays(50)->diffForHumans(['parts' => 2, 'short' => true])]) }}</div>
                                <div>{{ __(':time', ['time' => \Carbon\Carbon::now()->addDays(50)->format('d.m.y, h:m')]) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="tournament-box">
                            <div class="tournament-box-title">{{ __('Status') }}</div>
                            <div class="tournament-box-content">
                                <div class="tournament-box-text">{{ __($tournament->status->name()) }}</div>
                                <div>{{ __('Closes :date', ['date' => \Carbon\Carbon::now()->days(77)->diffForHumans(['parts' => 2, 'short' => true])]) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row tournament-boxes">
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
                    <div class="col-lg-6">
                        <div class="tournament-box">
                            <div class="tournament-box-title">{{ __('Format') }}</div>
                            <div class="tournament-box-content">
                                <div class="tournament-box-text">{{ __($tournament->format->name()) }}</div>
                                <div>
                                    2 vs 2
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row tournament-boxes">
                    <div class="col-lg-12">
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-info btn-sm">{{ __('View Tournament') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
