@extends('parts.base')

@section('content')
    @php($background = "background: linear-gradient(360deg, #242424 1%, rgba(26, 26, 32, 0) 60%)")
    <div class="container">
        @foreach($maps as $row)
            <div class="row justify-content-center mt-4">
                @foreach($row as $map)
                    <div class="col-lg-5">
                        <div class="card map">
                            <div class="map-background" style="{{ $background }}, url('{{ $map['background'] }}')">
                            </div>
                            <div class="card-body text-center">
                                <h5>
                                    <a href="{{ $map['url'] }}" target="_blank" rel="noreferrer">
                                        {{ $map['song'] }}
                                    </a>
                                </h5>
                                <div class="row mt-4">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="text-center mb-4">
                                            <span class="text-right text-bold">Type:</span>
                                            <span class="text-left">{{ $map['type'] }}</span>
                                        </div>
                                        <div class="text-center">
                                            <span class="text-right text-bold">Length:</span>
                                            <span class="text-left">{{ $map['length'] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="text-center mb-4">
                                            <span class="text-right text-bold">Rating:</span>
                                            <span class="text-left">{{ $map['rating'] }}</span>
                                        </div>
                                        <div class="text-center">
                                            <span class="text-right text-bold">BPM:</span>
                                            <span class="text-left">{{ $map['bpm'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

{{--        <div class="row justify-content-center mt-3">--}}
{{--            <div class="col-lg-3 text-center">--}}
{{--                <div class="d-grid gap-1">--}}
{{--                    <a href="{{ $download }}" class="btn btn-primary">Download all</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection
