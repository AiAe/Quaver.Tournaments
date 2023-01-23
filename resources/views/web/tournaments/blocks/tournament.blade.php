<div class="tournament">
    <div class="row">
        <div class="col-lg-3 col-md-3 d-flex align-items-center">
            <img src="{{ asset('assets/img/temp/noimage.jpg') }}" class="img-fluid">
        </div>
        <div class="col-lg-6 col-md-9 d-flex align-items-center text-center">
            <div class="tournament-details">
                <h1>{{ $tournament->name }}</h1>

                <div class="d-flex align-items-center justify-content-evenly tournament-boxes">
                    <div>
                        {{ __('Starts in :time', ['time' => \Carbon\Carbon::now()->addDays(50)->diffForHumans(['parts' => 2, 'short' => true])]) }}
                    </div>
                    <div>
                        {{ __(':time', ['time' => \Carbon\Carbon::now()->addDays(50)->format('d.m.y, h:m')]) }}
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-evenly tournament-boxes">
                    <div>
                        <div>{{ __('Format') }}</div>
                        <div>{{ __($tournament->format->name()) }}</div>
                    </div>
                    <div>
                        <div>{{ __('Status') }}</div>
                        <div>{{ __($tournament->status->name()) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 d-flex align-items-center justify-content-center text-center">
            <div>
                <div class="mb-2">
                    {{ __('Prize') }}
                    <div>500$</div>
                </div>
                <a href="#" class="btn btn-info btn-sm">{{ __('View Tournament') }}</a>
                <p class="mb-0 mt-2">
                    Top 3 Players
                </p>
                <p>
                    Win a Cash Prize
                </p>
            </div>
        </div>
    </div>
</div>
