@extends('web.tournaments.parts.base')

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>{{ $title }}</h1>
        </header>
    </div>
@endpush

@section('section')
    <div class="card">
        <div class="card-body position-relative rules-field">
            @can('update', $tournament)
                <div class="position-absolute" style="top: 10px; right: 10px;">
                    <button class="btn btn-primary btn-sm" type="button" data-bs-target="#tournamentRulesEdit"
                            data-bs-toggle="modal">
                        {{ __('Edit') }}
                    </button>
                </div>
            @endcan
            @if($tournament->rules)
                <x-markdown>{{ $tournament->rules }}</x-markdown>
            @else
                <div class="text-center">
                    {{ __('Rules are yet to be added!') }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    @can('update', $tournament)
        <script>
            document.addEventListener("DOMContentLoaded", function (event) {
                new SimpleMDE({
                    element: document.getElementById("textareaRules"),
                    toolbar: ["bold", "italic", "strikethrough", "heading", "|", "quote", "unordered-list", "ordered-list", "|", "link", "image", "table"],
                });
            });
        </script>
    @endcan
@endpush

@push('modals')
    @can('update', $tournament)
        <div class="modal modal-lg fade" id="tournamentRulesEdit" tabindex="-1"
             aria-labelledby="tournamentRulesEditLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tournamentRulesEditLabel">{{ __('Edit Rules') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('web.tournaments.rules.update', ['tournament' => $tournament]) }}"
                          method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <textarea id="textareaRules" name="rules">{{ $tournament->getMeta('rules', '') }}</textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endpush
