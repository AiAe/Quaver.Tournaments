@extends('parts.base')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-body text-center">
                <div class="p-2">
                    <h1 class="pb-3">Welcome to the website for the Quaver Official Tournament!</h1>
                    <p style="font-size: 18px;">
                        If you're a 4K player looking to show off your skills, this tournament will be the perfect place
                        to do so once again!<br>
                        Until we are ready to open registrations for the second edition of QOT and
                        you're only wanting to play, <br>please check the schedule and come back around then to
                        register!<br><br>
                        <strong>In the meantime you can suggest maps for the tournament <a href="#">here</a>.</strong>
                    </p>
                </div>
                <hr>
                <div class="p-3">

                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="mb-4">Schedule</h3>
                            <table class="table table-dark table-schedule">
                                <tbody>
                                <tr>
                                    <td>Registration phase</td>
                                    <td>January 16th - January 30th</td>
                                </tr>
                                <tr>
                                    <td>Qualifiers Mappool Showcase</td>
                                    <td>January 30th</td>
                                </tr>
                                <tr>
                                    <td>Qualifiers</td>
                                    <td>February 5th - February 6th</td>
                                </tr>
                                <tr>
                                    <td>Round of 128</td>
                                    <td>February 12th - February 13th</td>
                                </tr>
                                <tr>
                                    <td>Round of 64</td>
                                    <td>February 19th - February 20th</td>
                                </tr>
                                <tr>
                                    <td>Round of 32</td>
                                    <td>February 26th - February 27th</td>
                                </tr>
                                <tr>
                                    <td>Round of 16</td>
                                    <td>March 5th - March 6th</td>
                                </tr>
                                <tr>
                                    <td>Quarterfinals</td>
                                    <td>March 12th - March 13th</td>
                                </tr>
                                <tr>
                                    <td>Semifinals</td>
                                    <td>March 19th - March 20th</td>
                                </tr>
                                <tr>
                                    <td>Finals</td>
                                    <td>March 26th - March 27th</td>
                                </tr>
                                <tr>
                                    <td>Grand Finals</td>
                                    <td>April 2nd - April 3rd</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <h3 class="mb-4">Rules</h3>
                            <table class="table table-dark table-rules">
                                <tbody>
                                <tr>
                                    <td>
                                        Double Elimination - This means there is a loser's bracket.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Each player is allowed to ban <strong>one</strong> maps from the map pool per
                                        match.<br>
                                        You can only ban one map per category.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Each player may choose one warm-up map to play before the match.<br>
                                        The warm-up must not exceed 4 minutes in length, and it must be uploaded on
                                        Quaver's website.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Free rate will be turned off (you must use the rate specified for each map)
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        If you are thinking of rescheduling your match, please do it up to 24 hours
                                        before your match time.<br>We will give you more information on how to
                                        reschedule
                                        in the coming days.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        If a disconnect happens up to 30 seconds into a match, it will be restarted.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        The tie-breaker map will only be played in the case of a tie (both players being
                                        one away from the point limit)
                                    </td>
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
                        Until we are ready to open registrations, we are looking for people who want to join our staff.
                        We are looking for referees, streamers, commentators, mappool selectors and mappers.
                        If you are interested in helping, <a href="{{ route('signupStaff') }}">apply here</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
