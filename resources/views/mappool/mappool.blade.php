@extends('parts.base')

@section('content')
    <div class="container mt-3">
        @if($round)
            <div class="alert alert-warning text-center">
                <p>Make sure you are logged in on the
                    <a href="https://quavergame.com/" target="_blank" rel="noreferrer">Quaver Website</a>
                    and have <a href="https://i.kys.ovh/0UcAh.png" target="_blank">pop-ups enabled</a> to be able to download the maps!
                </p>
                <p>Mirror modifier can be used on any map. Other modifiers and rates listed below are forced.</p>
                <p>Remember to apply the recommended local offsets to every map
                    and update online offsets from Quaver options.</p>
            </div>
            <div class="text-white text-center">
                <h2>Current round</h2>
            </div>
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between">
                    <div>{{ $round->name }}</div>
                    <div>
                        <button class="btn btn-secondary btn-sm download-round" data-round="latest-round">
                            Download All
                        </button>
                        <button class="btn btn-secondary btn-sm download-ingame-round" data-round="latest-round">
                            Download All In-Game
                        </button>
                    </div>
                </div>
                <div id="latest-round">
                    @include('mappool.mappol_table', ["maps" => $round->maps])
                </div>
            </div>

            @if(sizeof($previous_rounds))
                <div>
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="collapse"
                                data-bs-target="#previous_rounds"
                                aria-controls="previous_rounds" aria-expanded="false"
                                aria-label="{{ __('Previous rounds') }}">
                            {{ __('Previous rounds') }}
                        </button>
                    </div>
                    <div id="previous_rounds" class="collapse">
                        @foreach($previous_rounds as $round)
                            <div class="card mt-3">
                                <div class="card-header d-flex justify-content-between">
                                    <div>{{ $round->name }}</div>
                                    <div>
                                        <button class="btn btn-secondary btn-sm download-round"
                                                data-round="round-{{ $round['id'] }}">
                                            Download All
                                        </button>
                                        <button class="btn btn-secondary btn-sm download-ingame-round"
                                                data-round="round-{{ $round['id'] }}">
                                            Download All In-Game
                                        </button>
                                    </div>
                                </div>
                                <div id="round-{{ $round['id'] }}">
                                    @include('mappool.mappol_table', ["maps" => $round->maps])
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @else
            <div class="card">
                <div class="card-body text-center">
                    <h3>{{ __('Mappool is not published yet!') }}</h3>
                </div>
            </div>
        @endif
    </div>
@endsection
