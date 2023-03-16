@extends('web.tournament.parts.base')

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>{{ $title }}</h1>
        </header>
    </div>
@endpush

@section('section')
    <div class="card">
        <nav>
            <div class="nav nav-tabs" id="settings-tab" role="tablist">
                <button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general"
                        type="button" role="tab" aria-controls="nav-general"
                        aria-selected="true">{{ __('General') }}</button>
                <button class="nav-link" id="nav-stages-tab" data-bs-toggle="tab" data-bs-target="#nav-stages"
                        type="button" role="tab" aria-controls="nav-stages"
                        aria-selected="false">{{ __('Stages') }}</button>
            </div>
        </nav>

        <div class="card-body">
            <div class="tab-content" id="settings-tabContent">
                <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab"
                     tabindex="0">
                    @include('web.tournament.components.settings.general')
                </div>
                <div class="tab-pane fade" id="nav-stages" role="tabpanel" aria-labelledby="nav-stages-tab" tabindex="0">
                    ...
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @can('update', $tournament)
        <script>
            document.addEventListener("DOMContentLoaded", function (event) {

            });
        </script>
    @endcan
@endpush
