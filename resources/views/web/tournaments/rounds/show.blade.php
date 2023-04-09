@extends('web.tournaments.parts.base')

@push('seo')
    {!! seo()->for($tournament) !!}
@endpush

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>{{ $round->name }}</h1>
        </header>
    </div>
@endpush

@section('section')

    <div class="d-flex justify-content-between mb-3">
{{--        @can('update', $tournament)--}}
{{--            <div>--}}
{{--                <a href="#tournamentGenerate" class="btn btn-primary btn-sm" data-bs-toggle="modal"--}}
{{--                   data-bs-target="#tournamentGenerate">{{ __('Generate Qualifiers Lobbies') }}</a>--}}
{{--            </div>--}}
{{--        @endcan--}}

        <div></div>

        @can('delete', $tournament)
            <div>
                {{ Form::open(['url' => route('web.tournaments.rounds.destroy', [$tournament, $round]), 'class' => 'd-flex']) }}
                @method('DELETE')
                {{ Form::submit(__('Delete Round'), ['class' => 'btn btn-danger btn-sm']) }}
                {{ Form::close() }}
            </div>
        @endcan
    </div>

    @if($round->round_text)
        <div class="card mb-3">
            <div class="card-header">
                {{ __('Round information') }}
            </div>
            <div class="card-body">
                {{ $round->round_text??"" }}
            </div>
        </div>
    @endif

    @php($matches = collect($round->matches()->with(['team1', 'team2'])->orderBy('timestamp')->get())->groupBy('timestamp'))

    <x-matches.list :matches="$matches"/>

    @if($round->mappool_visible)
        <div class="mappools mt-3">
            <div class="d-flex justify-content-between align-items-center round-name">
                <div class="d-flex align-items-center"><span></span>{{ __('Maps') }}</div>
                <div class="d-lg-flex d-md-flex d-sm-none d-none" style="gap: 10px;">
                    <div class="d-flex" style="gap: 10px;">
                        <a href="#" class="btn btn-primary btn-sm">{{ __('Download') }}</a>
                        <a href="#" class="btn btn-primary btn-sm">{{ __('Download In-Game') }}</a>
                    </div>
                </div>
            </div>

            <x-mappool.map-list :maps="$round->maps"/>
        </div>
    @endif
@endsection

@push('modals')
    @can('update', $tournament)
        <div class="modal modal-lg fade" id="tournamentGenerate" tabindex="-1"
             aria-labelledby="tournamentGenerateLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="tournamentGenerateLabel">{{ __('Generate Match') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{ Form::open(['url' => '']) }}
                    <div class="modal-body">
                        <div id="timestamps">
                            <div class="form-group">
                                <label class="form-label">{{ __('Timestamp') }}</label>
                                {{ Form::text('timestamps[]', '', ['class' => 'form-control datetimepicker']) }}
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-2">
                            {{ Form::button('Add timestamp', ['class' => 'btn btn-primary btn-sm', 'id' => 'add_timestamp']) }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Generate') }}</button>
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

            const addTimestamp = document.getElementById('add_timestamp');

            addTimestamp.addEventListener('click', function () {
                let formGroup = document.createElement("div");

            });
        });
    </script>
@endpush
