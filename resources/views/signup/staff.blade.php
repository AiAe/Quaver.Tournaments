@extends('parts.base')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">{{ __('Staff Registration') }}</div>
                    <div class="card-body">
                        {{ Form::open(['url' => route('signupPost', 'staff')]) }}
                        <div>
                            <label class="form-label">{{ __('Quaver Username') }}</label>
                            {{ Form::text('', $loggedUser['quaver_username'], ['class' => 'form-control', 'disabled' => 'true', 'readonly' => 'true']) }}
                        </div>

                        <div class="mt-3">
                            <label class="form-label">{{ __('Discord Username') }}</label>
                            {{ Form::text('', $loggedUser['discord_username'], ['class' => 'form-control', 'disabled' => 'disabled', 'readonly' => 'true']) }}
                        </div>

                        <div class="mt-3">
                            <label class="form-label">{{ __('Staff Roles') }}</label>
                            <div class="form-text mb-3">
                                Please select all the roles you'd like to apply for.
                                Make sure you have the time to commit to the role(s) you are applying for.
                            </div>
                            <div class="form-check">
                                {{ Form::checkbox('roles[]', 'referee', false, ['class' => 'form-check-input', 'id' => 'referee']) }}
                                <label class="form-check-label" for="referee">
                                    {{ __('Referee') }}
                                </label>
                            </div>
                            <div class="form-check">
                                {{ Form::checkbox('roles[]', 'mappool', false, ['class' => 'form-check-input', 'id' => 'mappool']) }}
                                <label class="form-check-label" for="mappool">
                                    {{ __('Mappool') }}
                                </label>
                            </div>
                            <div class="form-check">
                                {{ Form::checkbox('roles[]', 'mapper', false, ['class' => 'form-check-input', 'id' => 'mapper']) }}
                                <label class="form-check-label" for="mapper">
                                    {{ __('Mapper') }}
                                </label>
                            </div>
                            <div class="form-check">
                                {{ Form::checkbox('roles[]', 'streamer', false, ['class' => 'form-check-input', 'id' => 'streamer']) }}
                                <label class="form-check-label" for="streamer">
                                    {{ __('Streamer') }}
                                </label>
                            </div>
                            <div class="form-check">
                                {{ Form::checkbox('roles[]', 'commentator', false, ['class' => 'form-check-input', 'id' => 'commentator']) }}
                                <label class="form-check-label" for="commentator">
                                    {{ __('Commentator') }}
                                </label>
                            </div>
                            @if($errors->has('roles'))
                                <span class="invalid-feedback  d-block" role="alert">
                                <strong>{{ $errors->first('roles') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="mt-3">
                            <label class="form-label">{{ __('Tell us more') }}</label>
                            <div class="form-text mb-1">Explain why we should pick you.</div>
                            <div class="form-text mb-1">For <strong>Commentators</strong> please make sure your microphone is clear.</div>
                            <div class="form-text mb-3">For <strong>Streamers</strong> please link <a href="https://speedtest.net/">SpeedTest</a> results and your <strong>Twitch channel</strong>.</div>
                            {{ Form::textarea('previous_experience', '', ['class' => 'form-control', 'rows' => 3]) }}
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary btn-sm">{{ __('Apply') }}</button>
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
