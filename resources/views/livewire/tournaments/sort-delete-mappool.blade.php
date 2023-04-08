<div>
    <div class="modal modal-lg fade"
         id="tournamentMappoolSort-{{ $tournament_stage_round['id']??0 }}" tabindex="-1"
         aria-labelledby="tournamentMappoolSortLabel" wire:ignore.self
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="tournamentMappoolSortLabel">{{ __('Sort / Delete Maps') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group" wire:sortable="updateMapOrder" wire:sortable.options="{animation:100}">
                        @foreach($maps as $map)
                            <li class="list-group-item d-flex justify-content-between" wire:key="map-{{ $map->id }}"
                                wire:sortable.item="{{ $map->id }}">
                                {{ $map->map }}
                                <div>
                                    <button wire:sortable.handle class="btn btn-primary btn-sm"><i
                                            class="bi bi-arrows-move"></i></button>
                                    <button class="btn btn-danger btn-sm" wire:click="deleteMap({{ $map->id }})"><i
                                            class="bi bi-trash-fill"></i></button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"
                            class="btn btn-primary">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('tournamentMappoolSort-{{ $tournament_stage_round['id']??0 }}')
            .addEventListener('hide.bs.modal', function () {
                location.reload();
            });
    </script>
</div>
