@extends('parts.base')

@section('content')
    <div class="container mt-3">
        @if($round)
            <div class="text-white text-center">
                <h2>Current round</h2>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    {{ $round->name }}
                </div>
                <div>
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
                                <div class="card-header">{{ $round->name }}</div>
                                <div>
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
