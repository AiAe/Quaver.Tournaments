@extends('parts.base')

@section('content')
    <div class="container mt-3">
        @include('parts.alerts')
        <div class="card">
            <div class="card-body">
                <div class="list-rules">
                    <ol>
                        <li>Double Elimination - This means there is a loser's bracket.</li>
                        <li>Each player is allowed to ban <strong>one</strong> map from the map pool per match.</li>
                        <li>Each player may choose one warm-up map to play before the match. The warm-up must be
                            below 4 minutes in length.
                        </li>
                        <li>Free rate will be turned off (you must use the rate specified for each map)</li>
                        <li>If you need rescheduling for your match, please do it up to 24 hours before your match
                            time.
                        </li>
                        <li>If a disconnect happens up to 30 seconds into a match, it will be restarted.</li>
                        <li>The tie-breaker map will only be played in the case of a tie (both players being one away
                            from the point limit)
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
