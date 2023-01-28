@php use App\Enums\TournamentFormat; @endphp
<aside class="sidebar-menu d-flex flex-column flex-shrink-0 text-white bg-dark">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a href="#" class="nav-link active">
                <i class="bi bi-info-square-fill"></i>
                {{ __('Information') }}
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-hammer"></i>
                {{ __('Rules') }}
            </a>
        </li>
        <li class="nav-item">
            @auth()
                @if($loggedUser->teams()->firstWhere('tournament_id', $tournament->id) == null)
                    <a class="nav-link" href="#tournamentRegister" data-bs-toggle="modal"
                       data-bs-target="#tournamentRegister">
                        <i class="bi bi-box-arrow-right"></i>
                        {{ __('Register') }}
                    </a>
                    @push('modals')
                        <livewire:tournament.register wire:key="{{ key('tournamentRegister') }}"
                                                      :tournament="$tournament"></livewire:tournament.register>
                    @endpush
                @elseif($tournament->format == TournamentFormat::Team)
                    <a class="nav-link">
                        <i class="bi bi-people"></i>
                        {{ __('Team') }}
                    </a>
                    <a class="nav-link">
                        <i class="bi bi-mailbox"></i>
                        {{ __('Invites') }}
                    </a>
                @endif
            @endauth
            @guest()
                <a class="nav-link" href="{{route('web.auth.oauth', 'quaver')}}">
                    <i class="bi bi-box-arrow-right"></i>
                    {{ __('Register') }}
                </a>
            @endguest
        </li>
        <hr>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-controller"></i>
                {{ __('Players') }}
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-music-note-beamed"></i>
                {{ __('Mappool') }}
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-journal"></i>
                {{ __('Bracket') }}
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-calendar"></i>
                {{ __('Schedules') }}
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-globe"></i>
                {{ __('Suggest Maps') }}
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-shield-fill"></i>
                {{ __('Apply for Staff') }}
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-people-fill"></i>
                {{ __('Staff') }}
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="bi bi-wrench"></i>
                {{ __('Settings') }}
            </a>
        </li>

    </ul>
</aside>
