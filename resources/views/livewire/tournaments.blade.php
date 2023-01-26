<div>
    <div class="row g-3 justify-content-evenly align-items-center py-3">
        <div class="col-md-6">
            <div class="input-group">
                <label class="input-group-text">{{ __('Tournament Search') }}</label>
                <input type="text" wire:model.lazy="search" class="form-control">
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
        @foreach($tournaments as $tournament)
            @include('web.tournaments.components.tournament', ['tournament' => $tournament])
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $tournaments->links() }}
    </div>
</div>
