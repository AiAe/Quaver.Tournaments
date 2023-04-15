<div>
    <div class="modal modal-lg fade" id="tournamentMatchAssignment-{{ $match->id }}" tabindex="-1"
         aria-labelledby="tournamentMatchAssignmentLabel-{{ $match->id }}" wire:ignore.self
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="tournamentMatchAssignmentLabel-{{ $match->id }}">{{ __('Match assign staff') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($tournament->userIsOrganizer($loggedUser) || $tournament->userIsHeadReferee($loggedUser) || $tournament->userIsHeadStreamer($loggedUser))
                        <div class="form-group mb-2">
                            <label class="form-label">{{ __('Staff member') }}</label>
                            {{ Form::select('user_id', app('tournamentStaffList'), $loggedUser->id, ['class' => 'form-control', 'wire:model' => 'user_id']) }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="form-label">{{ __('Available roles') }}</label>
                        <div>
                            @if($tournament->userIsReferee($loggedUser))
                                {{ Form::button(__('Referee'), ['class' => 'btn btn-primary btn-sm', 'wire:click' => 'referee']) }}
                            @endif
                            @if($tournament->userIsStreamer($loggedUser))
                                {{ Form::button(__('Streamer'), ['class' => 'btn btn-info btn-sm', 'wire:click' => 'streamer']) }}
                            @endif
                            @if($tournament->userIsCommentator($loggedUser))
                                {{ Form::button(__('Commentator'), ['class' => 'btn btn-warning btn-sm', 'wire:click' => 'commentator']) }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
