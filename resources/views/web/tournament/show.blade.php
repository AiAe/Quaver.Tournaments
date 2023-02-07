@extends('web.tournament.parts.base')

@section('section')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <img src="{{ asset('assets/img/cover_l_q.png') }}" class="img-fluid">
                <div class="card-body">
                    <h1>{{ $tournament->name }}</h1>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <div>
                        <a href="#" class="btn btn-secondary btn-sm">
                            <i class="bi bi-discord"></i>
                            {{ __('Discord') }}
                        </a>
                        <a href="#" class="btn btn-secondary btn-sm">
                            <i class="bi bi-twitch"></i>
                            {{ __('Twitch') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-6">
            <h3>Schedule</h3>
        </div>
        <div class="col-lg-6">
            <h3>Prizes</h3>
        </div>
    </div>
@endsection
