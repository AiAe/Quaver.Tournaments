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

                    <div class="row">
                        <label class="form-label" for="timestampInput">{{ __('Timestamp') }}</label>
                    </div>
                    <div class="row g-2">
                        <div class="col-9">
                            <input type="text" wire:model="timestampInput" class="form-control datetimepicker col-9"
                                   id="timestampInput">
                        </div>
                        <div class="col-3">
                            <button wire:click="addTimestamp()"
                                    class="btn btn-primary btn-sm col-3">{{ __('Add') }}</button>
                        </div>
                    </div>

                    <div class="mt-3">
                        <ul>
                            @foreach($this->timestamps as $key => $value)
                                <li>

                                    <span>{{$value}}</span>
                                    <button wire:click="removeTimestamp({{$key}})"
                                            class="btn btn-danger btn-sm list-inline">{{ __('X') }}</button>
                                </li>
                            @endforeach
                        </ul>
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
        flatpickr(".datetimepicker", {
            enableTime: true,
            time_24hr: true
        });
    });
</script>
