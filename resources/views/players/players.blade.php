@extends('parts.base')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @include('parts.alerts')
                <div class="card">
                    <div class="card-header">{{ __('Players') }}</div>
                    <div class="card-body">
                        @if(!count($players))
                            {{ __('No players have sign up yet!') }}
                        @else
                            <div class="row">
                                @foreach($players as $player)
                                    <div class="col-lg-6 mb-4">
                                        <a href="{{ route('quaverUser', $player->user->quaver_user_id) }}" target="_blank">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $player->user->quaver_avatar }}" width="70" height="70"
                                                     alt="{{ $player->user->quaver_username }}">
                                                <div style="margin-left: 10px;">
                                                    <div>
                                                        <img
                                                            src="https://static.quavergame.com/img/flags/{{ $player->user['quaver_player']['country'] }}.png"
                                                            alt="{{ $player->user['quaver_player']['country'] }}">
                                                        {{ $player->user->quaver_username }}
                                                    </div>
                                                    <div class="text-white">{{ __('Rank') }}:
                                                        #{{ number_format($player->user['quaver_player'][config('app.game_mode')]['globalRank']) }}</div>
                                                    <div class="text-white">
                                                        {{ $player->data['timezone'] }}
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            {{ $players->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
