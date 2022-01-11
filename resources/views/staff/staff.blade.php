@extends('parts.base')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-12">
                @include('parts.alerts')
            </div>
            <div class="col-lg-6">
                @if(isset($staff['organisers']))
                    <div class="card mb-4">
                        <div class="card-header">{{ __('Organizers') }}</div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                @foreach($staff['organisers'] as $player)
                                    <div class="col-lg-4 col-md-3 col-4 mb-3">
                                        @include('staff.card', [$player])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-6">
                @if(isset($staff['spreadsheeters']))
                    <div class="card mb-4">
                        <div class="card-header">{{ __('Spreadsheeters') }}</div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                @foreach($staff['spreadsheeters'] as $player)
                                    <div class="col-lg-4 col-md-3 col-4 mb-3">
                                        @include('staff.card', [$player])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @if(isset($staff['graphics']))
            <div class="card mb-4">
                <div class="card-header">{{ __('Graphics') }}</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        @foreach($staff['graphics'] as $player)
                            <div class="col-lg-2 col-md-3 col-4 mb-3">
                                @include('staff.card', [$player])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if(isset($staff['mappoolers']))
            <div class="card mb-4">
                <div class="card-header">{{ __('Mappool Selectors') }}</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        @foreach($staff['mappoolers'] as $player)
                            <div class="col-lg-2 col-md-3 col-4 mb-3">
                                @include('staff.card', [$player])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if(isset($staff['mappers']))
            <div class="card mb-4">
                <div class="card-header">{{ __('Mappers') }}</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        @foreach($staff['mappers'] as $player)
                            <div class="col-lg-2 col-md-3 col-4 mb-3">
                                @include('staff.card', [$player])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if(isset($staff['referees']))
            <div class="card mb-4">
                <div class="card-header">{{ __('Referees') }}</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        @foreach($staff['referees'] as $player)
                            <div class="col-lg-2 col-md-3 col-4 mb-3">
                                @include('staff.card', [$player])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if(isset($staff['streamers']))
            <div class="card mb-4">
                <div class="card-header">{{ __('Streamers') }}</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        @foreach($staff['streamers'] as $player)
                            <div class="col-lg-2 col-md-3 col-4 mb-3">
                                @include('staff.card', [$player])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if(isset($staff['commentators']))
            <div class="card mb-4">
                <div class="card-header">{{ __('Commentators') }}</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        @foreach($staff['commentators'] as $player)
                            <div class="col-lg-2 col-md-3 col-4 mb-3">
                                @include('staff.card', [$player])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
