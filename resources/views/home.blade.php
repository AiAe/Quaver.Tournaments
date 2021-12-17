@extends('parts.base')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-body">
                <h1>Official 4 Keys Tournament Registrations Open!</h1>
                <p>
                    If you are a player looking to show off your skills, compete with other players, and win cool
                    prizes, we have a very special announcement for you. That's right! We're finally ready to host our
                    first official 4 Key tournament!
                </p>
                <p>
                    This tournament is for players of all skill levels. If you are new to the game or an experienced
                    player, be sure to sign up and participate!
                </p>
                <p>
                    Please read below for more information on rules, dates, prizes, how to sign up, and more!
                </p>

                <div>
                    @auth
                        @if(!Auth::user()->discord_user_id)
                            <a href="{{ route('oauth', 'discord') }}" class="btn btn-primary">{{ __('Connect to Discord') }}</a>
                        @endif
                    @endauth

                    @guest
                        <a href="{{ route('oauth', 'quaver') }}" class="btn btn-primary">{{ __('Login with Quaver') }}</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection
