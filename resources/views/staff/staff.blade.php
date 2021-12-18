@extends('parts.base')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-6">
                @if(isset($staff['organisers']))
                    <div>
                        <div class="staff-header">Organizers</div>
                        <div class="row justify-content-center">
                            @foreach($staff['organisers'] as $player)
                                <div class="col-md-4 mb-3">
                                    @include('staff.card', [$player])
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-6">
                @if(isset($staff['spreadsheeters']))
                    <div>
                        <div class="staff-header">Spreadsheeters</div>
                        <div class="row justify-content-center">
                            @foreach($staff['spreadsheeters'] as $player)
                                <div class="col-md-4 mb-3">
                                    @include('staff.card', [$player])
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @if(isset($staff['graphics']))
            <div>
                <div class="staff-header">Graphics</div>
                <div class="row justify-content-center">
                    @foreach($staff['graphics'] as $player)
                        <div class="col-md-2 mb-3">
                            @include('staff.card', [$player])
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if(isset($staff['mappoolers']))
            <div>
                <div class="staff-header">Mappool Selectors</div>
                <div class="row justify-content-center">
                    @foreach($staff['mappoolers'] as $player)
                        <div class="col-md-2 mb-3">
                            @include('staff.card', [$player])
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if(isset($staff['mappers']))
            <div>
                <div class="staff-header">Mappers</div>
                <div class="row justify-content-center">
                    @foreach($staff['mappers'] as $player)
                        <div class="col-md-2 mb-3">
                            @include('staff.card', [$player])
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if(isset($staff['referees']))
            <div>
                <div class="staff-header">Referees</div>
                <div class="row justify-content-center">
                    @foreach($staff['referees'] as $player)
                        <div class="col-md-2 mb-3">
                            @include('staff.card', [$player])
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if(isset($staff['streamers']))
            <div>
                <div class="staff-header">Streamers</div>
                <div class="row justify-content-center">
                    @foreach($staff['streamers'] as $player)
                        <div class="col-md-2 mb-3">
                            @include('staff.card', [$player])
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if(isset($staff['commentators']))
            <div>
                <div class="staff-header">Commentators</div>
                <div class="row justify-content-center">
                    @foreach($staff['commentators'] as $player)
                        <div class="col-md-2 mb-3">
                            @include('staff.card', [$player])
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
