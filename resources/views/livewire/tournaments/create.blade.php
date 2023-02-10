<div>
    <div class="modal modal-lg fade" id="tournamentCreate" tabindex="-1" aria-labelledby="tournamentCreateLabel" wire:ignore.self
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tournamentCreateLabel">{{ __('Create Tournament') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="create">
                    <div class="modal-body">
                        <div>
                            <label class="form-label">{{ __('Name') }}</label>
                            <input type="text" wire:model="name" class="form-control">
                            @error('name') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-2">
                            <label class="form-label">{{ __('Url') }}</label>
                            <div class="input-group">
                                <label class="input-group-text">{{ __('/tournaments/') }}</label>
                                <input type="text" wire:model="slug" class="form-control">
                                <button wire:click="generate_slug" class="btn btn-primary btn-sm" type="button">{{ __('Generate url') }}</button>
                            </div>
                            @error('slug') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-2">
                            <label class="form-label">{{ __('Mode') }}</label>
                            <select wire:model="mode" class="form-control">
                                @foreach(\App\Enums\TournamentGameMode::cases() as $mode)
                                    <option value="{{ $mode->value }}">{{ $mode->name() }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-2">
                            <label class="form-label">{{ __('Format') }}</label>
                            <select wire:model="format" class="form-control">
                                @foreach(\App\Enums\TournamentFormat::cases() as $format)
                                    <option value="{{ $format->value }}">{{ $format->name() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
