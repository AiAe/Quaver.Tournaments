<div>
    <div class="modal modal-lg fade" id="tournamentRegister" tabindex="-1" aria-labelledby="tournamentRegisterLabel"
         wire:ignore.self
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tournamentRegisterLabel">{{ __('Register') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if(Auth::user()->has_discord())
                    <form wire:submit.prevent="create">
                        @if($tournament->format == \App\Enums\TournamentFormat::Team)
                            <div class="modal-body">
                                <div>
                                    <label class="form-label">{{ __('Team Name') }}</label>
                                    <input type="text" wire:model="name" class="form-control">
                                    @error('name') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="mt-2">
                                    <label class="form-label">{{ __('Url') }}</label>
                                    <div class="input-group">
                                        <label class="input-group-text">{{ __('/team/') }}</label>
                                        <input type="text" wire:model="slug" class="form-control">
                                        <button wire:click="generate_slug" class="btn btn-primary btn-sm"
                                                type="button">{{ __('Generate url') }}</button>
                                    </div>
                                    @error('slug') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                            </div>
                        @else
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">{{ __('Decline') }}</button>
                                <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                            </div>
                        @endif
                    </form>
                @else
                    <div class="modal-body text-center">
                        <p style="font-size: 18px;" class="text-danger">
                            {{ __('You need to connect your Discord before you can register for tournament!') }}
                        </p>
                        <div class="mt-2">
                            <a href="{{ route('web.auth.oauth', ['driver' => 'discord', 'redirect' => current_route("#tournamentRegister")]) }}"
                               class="btn btn-primary">{{ __('Connect Discord') }}</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (window.location.href.indexOf('#tournamentRegister') !== -1) {
                const tournamentRegister = new Bootstrap.Modal('#tournamentRegister');
                tournamentRegister.show();
            }
        });
    </script>
@endpush
