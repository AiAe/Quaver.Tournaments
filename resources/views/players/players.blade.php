@extends('parts.base')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @include('parts.alerts')
                <div class="card">
                    <div class="card-header">{{ __('Players') }}</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($players as $player)
                                <div class="col-lg-4 mb-4">
                                    <a href="{{ route('quaver', $player->user->quaver_user_id) }}" target="_blank">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $player->user->quaver_avatar }}" width="50" height="50"
                                                 alt="{{ $player->user->quaver_username }}">
                                            <div style="margin-left: 10px;">
                                                {{ $player->user->quaver_username }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        {{ $players->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
