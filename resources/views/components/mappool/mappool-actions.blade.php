<div>
    <div class="d-lg-flex d-md-flex d-sm-none d-none mapset-links position-relative" style="gap: 10px; z-index: 5;">
        {{--                        <a href="#" class="btn btn-primary btn-sm">{{ __('Download') }}</a>--}}
        {{--                        <a href="#" class="btn btn-primary btn-sm">{{ __('Download In-Game') }}</a>--}}
        @if($loggedUser && $loggedUser->can('updateMappool', [$tournament, $round]))
            <div class="btn-group">
                <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal"
                   data-bs-target="#tournamentMappool-{{ $round->id }}">
                    {{ __('Add Map') }}
                </a>

                <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                   data-bs-target="#tournamentMappoolSort-{{ $round->id }}">
                    {{ __('Sort/Delete maps') }}
                </a>

                <livewire:tournaments.publish-mappool :round="$round"></livewire:tournaments.publish-mappool>
            </div>
            @push('modals')
                <livewire:tournaments.sort-delete-mappool :tournament="$tournament" :tournament_stage_round="$round"
                                                          :maps="$round->maps"></livewire:tournaments.sort-delete-mappool>
                <livewire:tournaments.update-mappool :tournament="$tournament"
                                                     :tournament_stage_round="$round"></livewire:tournaments.update-mappool>
            @endpush
        @endif

    </div>
</div>
