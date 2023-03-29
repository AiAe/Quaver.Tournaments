@php use App\Enums\TournamentFormat;use App\Models\Team; @endphp

<x-sidebar.group>
    <x-sidebar.item route="web.tournaments.show" :routeParams="$tournament" icon="bi-info-square-fill">
        {{ __('Information') }}
    </x-sidebar.item>
    <x-sidebar.item route="web.tournaments.rules.show" :routeParams="$tournament" icon="bi-hammer">
        {{ __('Rules') }}
    </x-sidebar.item>
</x-sidebar.group>

@can('create', [Team::class, $tournament])
    <x-sidebar.group>
        <x-sidebar.item icon="bi-box-arrow-right" data-bs-toggle="modal" data-bs-target="#tournamentRegister">
            {{ __('Register') }}
        </x-sidebar.item>
    </x-sidebar.group>
    @push('modals')
        @livewire('tournaments.register', ['tournament' => $tournament], key($tournament))
    @endpush
@endcan

@auth()
    @php($team = $loggedUser->teams()->firstWhere('tournament_id', $tournament->id))
    @if($team && $tournament->format == TournamentFormat::Team)
        <x-sidebar.group>
            <x-sidebar.item route="web.tournaments.teams.show" :routeParams="compact('tournament','team')"
                            icon="bi-people">
                {{ __('My Team') }}
            </x-sidebar.item>
        </x-sidebar.group>
    @endif
@endauth

@guest()
    <x-sidebar.group>
        <x-sidebar.item route="web.auth.oauth" routeParams="quaver" icon="bi-box-arrow-right">
            {{ __('Register') }}
        </x-sidebar.item>
    </x-sidebar.group>
@endguest

<x-sidebar.group>
    <x-sidebar.item route="web.tournaments.teams.index" :routeParams="$tournament" icon="bi-controller">
        @if($tournament->format == TournamentFormat::Team)
            {{ __('Teams') }}
        @else
            {{ __('Players') }}
        @endif
    </x-sidebar.item>
</x-sidebar.group>

<x-sidebar.group>
    <x-sidebar.item route="web.tournaments.mappools" :route-params="$tournament" icon="bi-music-note-beamed">
        {{ __('Mappool') }}
    </x-sidebar.item>

    {{--    <a href="#" class="list-group-item">--}}
    {{--        <i class="bi bi-journal"></i>--}}
    {{--        {{ __('Bracket') }}--}}
    {{--    </a>--}}

    <x-sidebar.item route="web.tournaments.schedules" :route-params="$tournament" icon="bi-journal">
        {{ __('Schedules') }}
    </x-sidebar.item>

    {{-- TODO: Pick icon--}}
    <x-sidebar.item route="web.tournaments.stages.index" :route-params="$tournament" icon="bi-calendar">
        {{ __('Stages') }}
    </x-sidebar.item>
</x-sidebar.group>

{{--<x-sidebar.group>--}}
{{--    <x-sidebar.item icon="bi-shield-fill">--}}
{{--        {{ __('Apply for Staff') }}--}}
{{--    </x-sidebar.item>--}}
{{--</x-sidebar.group>--}}

<x-sidebar.group>
    <x-sidebar.item route="web.tournaments.staff.index" :route-params="$tournament" icon="bi-people-fill">
        {{ __('Staff') }}
    </x-sidebar.item>
</x-sidebar.group>

@can('update', $tournament)
    <x-sidebar.group>
        <x-sidebar.item icon="bi-wrench">
            {{ __('Settings') }}
        </x-sidebar.item>
    </x-sidebar.group>
@endcan
