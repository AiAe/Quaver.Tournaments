<div>
    <div class="modal modal-lg fade" id="tournamentGenerateSwiss" tabindex="-1"
         aria-labelledby="tournamentGenerateSwissLabel"
         aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="tournamentGenerateSwissLabel">{{ __('Import CSV') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" wire:model="label" class="form-control" placeholder="SW1">
                    <textarea class="form-control" rows="10" wire:model="csv"></textarea>
                </div>
                <div class="modal-footer">
                    <button wire:click="import" class="btn btn-primary">{{ __('Import') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
