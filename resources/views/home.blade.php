@extends('parts.base')

@section('content')
    <div class="container mt-3">
        @include('parts.alerts')
        <div class="card">
            <div class="card-body text-center">
                <div class="p-2">
                    <h1 class="pb-3">Welcome to the website for the Quaver Official Tournament!</h1>
                    <p style="font-size: 18px;">
                        <h4><a href="{{ route('mappool') }}">Click here</a> to view the RO128 Mappool.</h4>
                        <br>
                        For more up-to-date information about the tournament, join our
                        <a href="https://discord.gg/quaver" target="_blank" rel="noreferrer">Discord</a> server <br>
                        and make sure to follow our
                        <a href="https://www.twitch.tv/quavergame" target="_blank" rel="noreferrer">Twitch</a>
                        channel for live streams.
                    </p>
                </div>
                <hr>
                <div class="p-3">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <h3 class="mb-4">{{ __('Schedule') }}</h3>
                            <table class="table table-dark table-schedule">
                                <tbody>
                                <tr>
                                    <td>Registration phase</td>
                                    <td>January 17th - January 28th</td>
                                </tr>
                                <tr>
                                    <td>Qualifiers Mappool Showcase</td>
                                    <td>January 30th</td>
                                </tr>
                                <tr>
                                    <td>Qualifiers</td>
                                    <td>February 4th - February 13th</td>
                                </tr>
                                <tr>
                                    <td>Round of 128</td>
                                    <td>February 19th - February 20th</td>
                                </tr>
                                <tr>
                                    <td>Round of 64</td>
                                    <td>February 26th - February 27th</td>
                                </tr>
                                <tr>
                                    <td>Round of 32</td>
                                    <td>March 5th - March 6th</td>
                                </tr>
                                <tr>
                                    <td>Round of 16</td>
                                    <td>March 12th - March 13th</td>
                                </tr>
                                <tr>
                                    <td>Quarterfinals</td>
                                    <td>March 19th - March 20th</td>
                                </tr>
                                <tr>
                                    <td>Semifinals</td>
                                    <td>March 26th - March 27th</td>
                                </tr>
                                <tr>
                                    <td>Finals</td>
                                    <td>April 2nd - April 3rd</td>
                                </tr>
                                <tr>
                                    <td>Grand Finals</td>
                                    <td>April 9th - April 10th</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="pb-4">
                    <h3 class="mt-4 mb-4">Prizes</h3>
                    <div id="prizes">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-1 order-sm-2 order-2">
                                <div class="card third-place">
                                    <div class="">
                                        <div class="medal">🥉</div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">$50 USD</li>
                                            <li class="list-group-item">1 Months Donator</li>
                                            <li class="list-group-item">Profile Badge</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 order-lg-2 order-sm-0 order-0">
                                <div class="card first-place">
                                    <div class="">
                                        <div class="medal">🥇</div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">$150 USD</li>
                                            <li class="list-group-item">3 Months Donator</li>
                                            <li class="list-group-item">Profile Badge</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 order-lg-3 order-sm-1 order-1">
                                <div class="card second-place">
                                    <div class="">
                                        <div class="medal">🥈</div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">$100 USD</li>
                                            <li class="list-group-item">2 Months Donator</li>
                                            <li class="list-group-item">Profile Badge</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="p-3">
                    <p style="font-size: 17px;" class="text-warning">
                        We are looking for more referees, streamers and commentators.
                        If you are interested in helping, <a href="{{ route('signupStaff') }}">apply here</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
