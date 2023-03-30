<div class="stage">
    <div class="stage-name d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <span></span> {{$stage->name}}
        </div>
        @can('update', $tournament)
            <div>
                <a class="btn btn-primary btn-sm" href="#tournamentStageRoundCreate-{{ $stage->id }}"
                   data-bs-toggle="modal"
                   data-bs-target="#tournamentStageRoundCreate-{{ $stage->id }}">{{ __('Create round') }}</a>
            </div>
        @endcan
    </div>
    <div class="stage-body">
        <div class="row">
            <div class="col-lg-6">
                {{ $stage->stage_text??"" }}
            </div>
            <div class="col-lg-6">
                @forelse($stage->rounds as $round)
                    <div class="round position-relative">
                        <div class="d-flex justify-content-between align-items-center">
                            {{ $round->name }}

                            <div>
                                {{ $round->starts_at->format('d M') }} - {{ $round->ends_at->format('d M') }}

                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>

                        <a class="stretched-link"
                           href="{{route('web.tournaments.rounds.show', ['tournament' => $tournament, 'round' => $round])}}"></a>
                    </div>
                @empty
                    <div class="col-lg-12">
                        {{ __('There are currently no rounds') }}
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('modals')
    @can('update', $tournament)
        <div class="modal modal-lg fade" id="tournamentStageRoundCreate-{{ $stage->id }}" tabindex="-1"
             aria-labelledby="tournamentStageRoundCreateLabel-{{ $stage->id }}"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tournamentStageRoundCreateLabel-{{ $stage->id }}">{{ __('Create Round') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{ Form::open(['url' => route('web.tournaments.rounds.store', $tournament)]) }}
                    {{ Form::hidden('tournament_stage_id', $stage->id) }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">{{ __('Round name') }}</label>
                            {{ Form::text('name', '', ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('Starts at') }}</label>
                            {{ Form::text('starts_at', '', ['class' => 'form-control datetimepicker']) }}
                        </div>

                        <div class="form-group">
                            <label class="form-label">{{ __('Ends at') }}</label>
                            {{ Form::text('ends_at', '', ['class' => 'form-control datetimepicker']) }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    @endcanany
@endpush

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            flatpickr(".datetimepicker", {
                enableTime: true
            });
        });
    </script>
@endpush
