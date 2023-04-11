<div>
    <div class="modal modal-lg fade" id="tournamentGenerate" tabindex="-1"
         aria-labelledby="tournamentGenerateLabel"
         aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="tournamentGenerateLabel">{{ __('Generate Match') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="timestamps">
                        @foreach($this->timestamps as $key => $value)
                            <div class="form-group mb-2">
                                <label class="form-label">{{ __('Timestamp') }}</label>
                                <input type="text" wire:model="timestamps.{{ $key }}"
                                       class="form-control datetimepicker">
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-end mt-2">
                        <button wire:click="addTimestamp({{ $i }})"
                                class="btn btn-primary btn-sm">{{ __('Add Timestamp') }}</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="generate" class="btn btn-primary">{{ __('Generate') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        Livewire.on('initDateTimePicker', () => {
            flatpickr(".datetimepicker", {
                enableTime: true,
                time_24hr: true
            });
        });
    });
</script>
