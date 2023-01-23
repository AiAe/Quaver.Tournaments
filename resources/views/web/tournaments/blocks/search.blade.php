<div class="container">
    {{ Form::open(['url' => route('web.tournaments.list'), 'method' => 'get']) }}
    <div class="d-flex justify-content-evenly align-items-center py-3">
        <div>
            <div class="input-group">
                <label class="input-group-text">{{ __('Tournament Search') }}</label>
                {{ Form::text('name', '', ['class' => 'form-control']) }}
            </div>
        </div>

        <div>
            <div class="input-group">
                <label class="input-group-text">{{ __('Format') }}</label>
                {{ Form::select('format', \App\Enums\TournamentFormat::array(), 1, ['class' => 'form-control']) }}
            </div>
        </div>

        <div>
            <div class="input-group">
                <label class="input-group-text">{{ __('Status') }}</label>
                {{ Form::select('format', \App\Enums\TournamentStatus::array(), 1, ['class' => 'form-control']) }}
            </div>
        </div>

        <div>
            {{ Form::submit(__('Search'), ['class' => 'btn btn-primary']) }}
        </div>
    </div>
    {{ Form::close() }}
</div>
