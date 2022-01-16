@extends('admin.parts.base')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">Enable tournament signups</div>
                    <div class="card-body">
                        {{ Form::open(['url' => route('admin.settings.toggle', "TOURNEY_SIGNUPS")]) }}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">{{ (config("app.tourney_signups")) ? __('Disable') : __('Enable')  }}</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">Lock website</div>
                    <div class="card-body">
                        {{ Form::open(['url' => route('admin.settings.toggle', "FORCE_LOCK")]) }}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">{{ (config("app.force_lock")) ? __('Disable') : __('Enable')  }}</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">Discord bot</div>
                    <div class="card-body">
                        {{ Form::open(['url' => route('admin.settings.toggle', "DISCORD_BOT")]) }}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">{{ (config("app.discord_bot")) ? __('Disable') : __('Enable')  }}</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
