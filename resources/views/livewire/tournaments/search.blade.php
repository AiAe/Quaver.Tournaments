<div>
    <div class="row g-3 justify-content-evenly align-items-center py-3">
        <div class="col-md-3">
            <div class="input-group">
                <label class="input-group-text">{{ __('Name') }}</label>
                <input type="text" wire:model.lazy="search" class="form-control">
            </div>
        </div>

        <div class="col-md-3">
            <div class="input-group">
                <label class="input-group-text">{{ __('Mode') }}</label>
                <select wire:model.lazy="mode" class="form-control">
                    <option value="" selected>{{ __('All') }}</option>
                    @foreach(\App\Enums\TournamentGameMode::cases() as $mode)
                        <option value="{{ $mode->value }}">{{ $mode->name() }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="input-group">
                <label class="input-group-text">{{ __('Format') }}</label>
                <select wire:model.lazy="format" class="form-control">
                    <option value="" selected>{{ __('All') }}</option>
                    @foreach(\App\Enums\TournamentFormat::cases() as $format)
                        <option value="{{ $format->value }}">{{ $format->name() }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="input-group">
                <label class="input-group-text">{{ __('Status') }}</label>
                <select wire:model.lazy="status" class="form-control">
                    <option value="" selected>{{ __('All') }}</option>
                    @foreach(\App\Enums\TournamentStatus::cases() as $status)
                        @if(!$show_unlisted)
                            @continue($status == \App\Enums\TournamentStatus::Unlisted)
                        @endif
                        <option value="{{ $status->value }}">{{ $status->name() }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="tournaments">
        <span wire:loading.delay wire:target="update">
            {{ __('Loading...') }}
        </span>
        <div class="row">
            @forelse($tournaments as $tournament)
                <div class="col-lg-6">
                    <x-tournament :tournament="$tournament"/>
                </div>
            @empty
                <div class="col-lg-12">
                    <div class="text-center py-4">
                        <h4>{{ __('No Tournaments found!') }}</h4>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $tournaments->links() }}
    </div>
</div>
