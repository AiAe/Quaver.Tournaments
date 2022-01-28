@extends('parts.base')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                @include('parts.alerts')
                <div class="card">
                    <div class="card-header">{{ __('Tournament Registration') }}</div>
                    <div class="card-body">
                        @if(!$has_registered)
                            {{ Form::open(['url' => route('signupPlayerPost')]) }}
                            <div>
                                <label class="form-label">{{ __('Quaver Username') }}</label>
                                {{ Form::text('', $loggedUser['quaver_username'], ['class' => 'form-control', 'disabled' => 'true', 'readonly' => 'true']) }}
                            </div>

                            <div class="mt-3">
                                <label class="form-label">{{ __('Discord Username') }}</label>
                                {{ Form::text('', $loggedUser['discord_username'], ['class' => 'form-control', 'disabled' => 'disabled', 'readonly' => 'true']) }}
                            </div>

                            <div class="mt-3">
                                <label class="form-label">{{ __('Time zone') }}</label>
                                {{ Form::select('timezone', collect(timezoneList())->pluck('label'), 97, ['class' => 'form-control']) }}
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">{{ __('Register') }}</button>
                            </div>
                            {{ Form::close() }}
                        @else
                            <div class="alert alert-info">
                                {{ __("You are registered for the tournament!") }}<br>
                                {{ __("If you wish to resign or reschedule please open ticket from") }} <strong>#tourney-help</strong>!<br>
                            </div>
                            <hr>
                            {{ Form::open(['url' => route('updateTimezonePost')]) }}
                            <div class="mt-3">
                                <label class="form-label">{{ __('Change Time zone') }}</label>
                                {{ Form::select('timezone', collect(timezoneList())->pluck('label'), array_search($has_registered->data['timezone'], array_column(timezoneList(), 'label')), ['class' => 'form-control']) }}
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">{{ __('Save') }}</button>
                            </div>
                            {{ Form::close() }}
                            <hr>
                            <div class="alert alert-dark">
                                If you don't have <strong>Tournament role</strong>, make sure that you are in
                                <a href="https://discord.gg/quaver" target="_blank" rel="noreferrer"><strong>Quaver's
                                        discord</strong></a>
                                then click <strong>Verify</strong> again.
                                <br>
                                <strong>It's important to be in the server to receive information about the
                                    tourney!</strong>
                            </div>

                            {{ Form::open(['url' => route('verifyPlayerPost')]) }}
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">{{ __('Verify') }}</button>
                            </div>
                            {{ Form::close() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
