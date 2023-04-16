@extends('web.layout.base')

@section('content')
    <div class="container">
        <div class="row">
            @if(isset($tournament) && $tournament->status == \App\Enums\TournamentStatus::Unlisted)
                <div class="col-lg-12">
                    <div class="alert alert-danger text-center">
                        {{ __('Tournament is Unlisted!') }}
                    </div>
                </div>
            @endif

            @stack('cover')
        </div>

        @php($has_alerts = false)

        @php($alerts = $tournament->getMeta('alerts')??[])
        @if($alerts)
            @foreach($alerts as $alert)
                @continue(!$alert['message'])
                @php($has_alerts = true)
                @php($alert_type = \App\Enums\AlertType::cases()[$alert['type']])
                <x-alert :alert="$alert"
                          :classes="$alert_type->style() . ' mt-3'"
                          :message="$alert['message']"
                          :link="$alert['link']"
                          :link_text="$alert['link_text']"
                ></x-alert>
            @endforeach
        @endif

        <div class="row {{ ($has_alerts) ? '' : 'mt-3' }}">
            <div class="col-lg-3">
                <div class="sticky-top mb-3" style="top: 80px; z-index: 200;">
                    <x-sidebar :tournament="$tournament"/>
                </div>
            </div>

            <div class="col-lg-9">
                @yield('section')
            </div>
        </div>
    </div>
@endsection
