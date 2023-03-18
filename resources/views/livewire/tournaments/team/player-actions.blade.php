<div>
    <div class="dropdown">
        <a class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-gear-wide"></i>
        </a>
        <ul class="dropdown-menu">
            @if(!$this->team->captain()->is($this->user) && $this->user->teams()->firstWhere('tournament_id', $this->team->tournament_id))
                <li>
                    <button class="dropdown-item" wire:click="change_captain">{{ __('Give captain') }}</button>
                </li>
            @endif
            @if(!$this->team->captain()->is($this->user))
                <li>
                    <button class="dropdown-item" wire:click="remove">{{ __('Kick') }}</button>
                </li>
            @endif
        </ul>
    </div>
</div>
