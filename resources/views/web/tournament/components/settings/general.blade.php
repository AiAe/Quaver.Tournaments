{{ Form::open(['url' => route('web.tournaments.settings.update', $tournament), 'method' => 'PUT']) }}
<div>
    <label class="form-label">{{ __('Tournament Name') }}</label>
    {{ Form::text('name', $tournament->name, ['class' => 'form-control']) }}
</div>

<div class="mt-3">
    {{ Form::submit(__('Save'), ['class' => 'btn btn-primary btn-sm']) }}
</div>
{{ Form::close() }}
