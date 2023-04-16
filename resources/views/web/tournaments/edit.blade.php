@extends('web.tournaments.parts.base')

@push('seo')
    {!! seo()->for($tournament) !!}
@endpush

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover" style="background: url('{{ asset('assets/img/cover_l_q.png') }}') center;"></header>
    </div>
@endpush

@section('section')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Tournament Status') }}
                </div>
                <div class="card-body">
                    {{ Form::open(['url' => route('web.tournaments.update', $tournament)]) }}
                    @method('PUT')
                    <div class="form-group">
                        <div class="mb-2 text-info">
                            {{ __('Current status') }}: <strong>{{ $tournament->status->name() }}</strong>
                        </div>
                        <div>
                            @php($tournament_status = \App\Enums\TournamentStatus::class)
                            @if($tournament->status == $tournament_status::Upcoming)
                                {{ Form::button($tournament_status::Unlisted->name(), ['class' => 'btn btn-danger btn-sm', 'name' => 'status', 'value' => $tournament_status::Unlisted, 'type' => 'submit']) }}
                            @endif

                            @if($tournament->status != $tournament_status::Upcoming)
                                {{ Form::button($tournament_status::Upcoming->name(), ['class' => 'btn btn-info btn-sm', 'name' => 'status', 'value' => $tournament_status::Upcoming, 'type' => 'submit']) }}
                            @endif

                            @if($tournament->status == $tournament_status::Unlisted || $tournament->status == $tournament_status::Upcoming)
                                {{ Form::button($tournament_status::RegistrationsOpen->name(), ['class' => 'btn btn-success btn-sm', 'name' => 'status', 'value' => $tournament_status::RegistrationsOpen, 'type' => 'submit']) }}
                            @endif

                            @if($tournament->status == $tournament_status::RegistrationsOpen)
                                {{ Form::button($tournament_status::Ongoing->name(), ['class' => 'btn btn-success btn-sm', 'name' => 'status', 'value' => $tournament_status::Ongoing, 'type' => 'submit']) }}
                            @endif

                            @if($tournament->status == $tournament_status::Ongoing)
                                {{ Form::button($tournament_status::Concluded->name(), ['class' => 'btn btn-warning btn-sm', 'name' => 'status', 'value' => $tournament_status::Concluded, 'type' => 'submit']) }}
                            @endif
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-header">
                    {{ __('Tournament Settings') }}
                </div>
                <div class="card-body">
                    {{ Form::open(['url' => route('web.tournaments.update', $tournament)]) }}
                    @method('PUT')

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label">{{ __('Tournament information') }}</label>
                                {{ Form::textarea('information', $tournament->getMeta('information')??"", ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Prize header') }}</label>
                                {{ Form::text('prize[header]', $tournament->getMeta('prize')['header']??"", ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Prize body') }}</label>
                                {{ Form::text('prize[body]', $tournament->getMeta('prize')['body']??"", ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Rank header') }}</label>
                                {{ Form::text('rank[header]', $tournament->getMeta('rank')['header']??"", ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Rank body') }}</label>
                                {{ Form::text('rank[body]', $tournament->getMeta('rank')['body']??"", ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Register question') }}</label>
                                {{ Form::text('register[question]', $tournament->getMeta('register')['question']??"", ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Register answer') }}
                                    <small>{{ __('(will be converted to lower case!)') }}</small></label>
                                {{ Form::input('password', 'register[answer]', $tournament->getMeta('register')['answer']??"", ['class' => 'form-control hidden-field']) }}
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Discord URL') }}</label>
                                {{ Form::text('discord', $tournament->getMeta('discord')??"", ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Twitch URL') }}</label>
                                {{ Form::text('twitch', $tournament->getMeta('twitch')??"", ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Spreadsheet URL') }}</label>
                                {{ Form::text('spreadsheet', $tournament->getMeta('spreadsheet')??"", ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Twitter URL') }}</label>
                                {{ Form::text('twitter', $tournament->getMeta('twitter')??"", ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Discord Webhook - Registrations') }}</label>
                                {{ Form::input('password', 'discord_webhook_registrations', $tournament->getMeta('discord_webhook_registrations')??"", ['class' => 'form-control hidden-field']) }}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Discord Webhook - Matches') }}</label>
                                {{ Form::input('password', 'discord_webhook_matches', $tournament->getMeta('discord_webhook_matches')??"", ['class' => 'form-control hidden-field']) }}
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Discord Webhook - Reminders') }}</label>
                                {{ Form::input('password', 'discord_webhook_reminders', $tournament->getMeta('discord_webhook_reminders')??"", ['class' => 'form-control hidden-field']) }}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Discord Webhook - Reminders Staff') }}</label>
                                {{ Form::input('password', 'discord_webhook_reminders_staff', $tournament->getMeta('discord_webhook_reminders_staff')??"", ['class' => 'form-control hidden-field']) }}
                            </div>
                        </div>
                    </div>

                    <hr>

                    @php($alerts = $tournament->getMeta('alerts'))
                    @php($alert = $alerts[0]??[])
                    <div class="row mt-2">
                        <div class="col-lg-12">
                            <label class="form-label">{{ __('Alert') }}</label>
                            <div class="input-group">
                                <span class="input-group-text">{{ __('Type') }}</span>
                                {{ Form::select('alerts[0][type]', \App\Enums\AlertType::array(), $alert['type']??0, ['class' => 'form-control']) }}
                                <span class="input-group-text">{{ __('Link') }}</span>
                                {{ Form::text('alerts[0][link]', $alert['link']??null, ['class' => 'form-control']) }}
                                <span class="input-group-text">{{ __('Link Text') }}</span>
                                {{ Form::text('alerts[0][link_text]', $alert['link_text']??null, ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group mt-2">
                                <label class="form-label">{{ __('Message') }}</label>
                                {{ Form::textarea('alerts[0][message]', $alert['message']??null, ['class' => 'form-control', 'rows' => '2']) }}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        {{ Form::submit(__('Save'), ['class' => 'btn btn-primary btn-sm']) }}
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const hiddenFields = document.getElementsByClassName('hidden-field');

        for (const field of hiddenFields) {
            field.addEventListener('focusin', (event) => {
                event.target.type = "text";
            });

            field.addEventListener('focusout', (event) => {
                event.target.type = "password";
            });
        }
    </script>
@endpush
