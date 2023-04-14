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
            @php($has_alerts = true)
            @foreach($alerts as $alert)
                <div class="alert {{ \App\Enums\AlertType::cases()[$alert['type']]->style() }}
                mt-3 d-flex align-items-center justify-content-between">
                    <div>{{ $alert['message']??"" }}</div>
                    @if($alert['link'])
                        <a href="{{ $alert['link'] }}" target="_blank" rel="noreferrer"
                           class="btn btn-secondary btn-sm">{{ $alert['link_text']??__('Visit') }}</a>
                    @endif
                </div>
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
