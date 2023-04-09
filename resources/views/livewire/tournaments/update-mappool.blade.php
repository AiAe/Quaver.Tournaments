<div>
    <div class="modal modal-lg fade" id="tournamentMappool-{{ $tournament_stage_round['id']??0 }}" tabindex="-1"
         aria-labelledby="tournamentMappoolLabel" wire:ignore.self
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="tournamentMappoolLabel">{{ __('Mappool') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{ Form::open(['wire:submit.prevent' => 'create', 'autocomplete' => 'off']) }}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <label class="input-group-text">{{ __('Map URL') }}</label>
                            {{ Form::text('quaver_map_url', '101634', ['class' => 'form-control', 'wire:model' => 'quaver_map_url']) }}
                            <button wire:click="fetch_map" class="btn btn-primary btn-sm"
                                    type="button">{{ __('Fetch Map') }}</button>
                        </div>
                        @error('map_not_found')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mt-2">
                        <label class="form-label">{{ __('Map ID') }}</label>
                        {{ Form::text('quaver_map_id', '', ['class' => 'form-control', 'wire:model' => 'quaver_map_id', 'readonly' => 'readonly']) }}
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Category') }}</label>
                                {{ Form::text('category', '', ['class' => 'form-control', 'wire:model' => 'category']) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">{{ __('Sub Category') }}</label>
                                {{ Form::text('sub_category', '', ['class' => 'form-control', 'wire:model' => 'sub_category']) }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label class="form-label">{{ __('Mods') }}</label>
                        {{ Form::text('mods', '', ['class' => 'form-control', 'wire:model' => 'mods']) }}
                        <small>{{ __('Use comma to separate mods: 1.05x,NM') }}</small>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">{{ __('Modded difficulty') }}</label>
                                {{ Form::text('modded_difficulty', '', ['class' => 'form-control', 'wire:model' => 'modded_difficulty']) }}
                                <small>{{ __('If rates are used write the correct difficulty rate') }}</small>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">{{ __('Modded BPM') }}</label>
                                {{ Form::text('modded_bpm', '', ['class' => 'form-control', 'wire:model' => 'modded_bpm']) }}
                                <small>{{ __('If rates are used write the correct BPM') }}</small>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">{{ __('Offset') }}</label>
                                {{ Form::text('offset', '', ['class' => 'form-control', 'wire:model' => 'offset']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
