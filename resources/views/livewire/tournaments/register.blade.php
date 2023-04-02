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
                    @php($discord_url = $tournament->getMeta('discord')??null)
                    @if($discord_url)
                        <div class="modal-body">
                            <div class="alert alert-danger mt-2 d-flex justify-content-between align-items-center">
                                <div>
                                    {{ __("Make sure to join the tournament's Discord server to get real time updates/reminders!") }}
                                </div>
                                <a href="{{ $discord_url }}" target="_blank" rel="noreferrer" class="btn btn-secondary btn-sm">{{ __('Join') }}</a>
                            </div>
                        </div>
                    @endif
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
                            @php($register_captcha = $tournament->getMeta('register'))
                            @php($captcha_question = $register_captcha['question']??null)

                            @if($captcha_question)
                                <div class="modal-body">
                                    <div>
                                        <label
                                            class="form-label d-block">{{ __('To verify your not a bot, answer this question:') }}</label>
                                        <label class="form-label text-warning">{{ $captcha_question }}</label>
                                        <input type="text" wire:model="captcha" class="form-control">
                                        @error('captcha') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            @endif

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
