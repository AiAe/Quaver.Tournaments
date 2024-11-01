@extends('web.layout.base')

@push('seo')
    {!! seo()->for(new \RalphJSmit\Laravel\SEO\Support\SEOData(title: 'Settings')) !!}
@endpush

@section('content')
    <div class="container">
        <header class="page-cover">
            <div>
                <h1>{{ __('Settings') }}</h1>
            </div>
        </header>
    </div>

    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                {{ Form::open(['url' => route('web.users.update')]) }}
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">{{ __('Username') }}</label>
                            {{ Form::text('', $loggedUser['username'], ['class' => 'form-control', 'readonly' => 'readonly']) }}
                            <small>{{ __('Usernames are getting updated every 24 hours!') }}</small>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">{{ __('Linked Discord ID') }}</label>
                        <div class="input-group">
                            {{ Form::text('', $loggedUser['discord_user_id'], ['class' => 'form-control', 'readonly' => 'readonly']) }}
                            @if($loggedUser['discord_user_id'] == null)
                                <div class="input-group-append">
                                    <a href="{{ route('web.auth.oauth', ['driver' => 'discord', 'redirect' => current_route()]) }}"
                                       class="btn btn-discord"
                                       style="border-bottom-left-radius: 0; border-top-left-radius: 0;">{{ __('Connect Discord') }}</a>
                                </div>
                                @else
                                <div class="input-group-append">
                                    <a href="{{ route('web.auth.oauth', ['driver' => 'discord', 'redirect' => current_route()]) }}" class="btn btn-discord">Re-link Discord</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">{{ __('Timezone') }}</label>
                            {{ Form::select('timezone_offset', [null => __('Select timezone')] + list_utc_offsets(), $loggedUser['timezone_offset']??null, ['class' => 'form-control']) }}
                            <small>{{ __('Detected timezone') }}: <span id="detected-timezone"></span></small>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    {{ Form::button(__('Save'), ['class' => 'btn btn-primary btn-sm', 'type' => 'submit']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>

        @can('create', \App\Models\Tournament::class)
            <div class="card mt-2">
                <div class="card-header">{{ __('Token') }}</div>
                <div class="card-body">
                    <livewire:user.token></livewire:user.token>
                </div>
            </div>
        @endcan
    </div>
@endsection

@push('scripts')
    <script>
        function displayTimezoneOffset(offset) {
            return offset < 0 ? `UTC${offset}` : `UTC+${offset}`;
        }

        const browserTimezone = -(new Date().getTimezoneOffset() / 60);

        document.getElementById('detected-timezone').textContent = displayTimezoneOffset(browserTimezone);
    </script>
@endpush
