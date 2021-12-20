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
                    <h3 class="mb-4">Schedule</h3>
                    <div><strong>Registration phase:</strong> January 16th - January 30th</div>
                    <div><strong>Qualifiers Mappool Showcase:</strong> January 30th</div>
                    <div><strong>Qualifiers:</strong> February 5th - February 6th</div>
                    <div><strong>Round of 128:</strong> February 12th - February 13th</div>
                    <div><strong>Round of 64:</strong> February 19th - February 20th</div>
                    <div><strong>Round of 32:</strong> February 26th - February 27th</div>
                    <div><strong>Round of 16:</strong> March 5th - March 6th</div>
                    <div><strong>Quarterfinals:</strong> March 12th - March 13th</div>
                    <div><strong>Semifinals:</strong> March 19th - March 20th</div>
                    <div><strong>Finals:</strong> March 26th - March 27th</div>
                    <div><strong>Grand Finals:</strong> April 2nd - April 3rd</div>
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
