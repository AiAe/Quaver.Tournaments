<div>
    @if($this->new_token)
        <div class="alert alert-danger">
            <p>
                {{ __('New token was generated! Make sure to save it!') }}
            </p>
            <p>
                {{ __('If the token is lost, you can generate new one! Old one will be revoked!') }}
            </p>
            <p class="bg-dark">
                <code>{{ $this->new_token }}</code>
            </p>
        </div>
    @endif

    <button wire:click="generate_token" class="btn btn-danger">{{ __('Get new token') }}</button>
</div>
