@extends('web.tournaments.parts.base')

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>{{ $title }}</h1>
        </header>
    </div>
@endpush

@section('section')
    @forelse($tournament->stages as $stage)
        <x-stages.card :stage="$stage" :tournament="$tournament"/>
    @empty
        <div class="card">
            <div class="card-body">
                {{ __('There are currently no stages') }}
            </div>
        </div>
    @endforelse

    @can('update', $tournament)
        <div class="mt-3 d-flex justify-content-center">
            <a class="btn btn-primary btn-sm" href="#tournamentStageCreate"
               data-bs-toggle="modal"
               data-bs-target="#tournamentStageCreate">
                {{ __('Create Stage') }}
            </a>
        </div>
    @endcan
@endsection

@push('modals')
    @can('update', $tournament)
        <div class="modal modal-lg fade" id="tournamentStageCreate" tabindex="-1"
             aria-labelledby="tournamentStageCreateLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tournamentStageCreateLabel">{{ __('Create Stage') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{ Form::open(['url' => route('web.tournaments.stages.store', $tournament)]) }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">{{ __('Stage name') }}</label>
                            {{ Form::text('name', '', ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('Stage format') }}</label>
                            {{ Form::select('stage_format', \App\Enums\TournamentStageFormat::array(), '', ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('Stage text') }}</label>
                            {{ Form::textarea('stage_text', '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    @endcan
@endpush
