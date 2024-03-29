@php use App\Enums\TournamentFormat;use App\Models\Team; @endphp

<x-sidebar.group>
    <x-sidebar.item route="web.tournaments.show" :routeParams="$tournament->slug" icon="bi-info-square-fill">
        {{ __('Information') }}
    </x-sidebar.item>
    <x-sidebar.item route="web.tournaments.rules.show" :routeParams="$tournament->slug" icon="bi-hammer">
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
    @if($loggedUserTeam && $tournament->format == TournamentFormat::Team)
        <x-sidebar.group>
            <x-sidebar.item icon="bi-people"
                            href="{{route('web.tournaments.teams.show',[$tournament, $loggedUserTeam])}}">
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
    <x-sidebar.item route="web.tournaments.teams.index" :routeParams="$tournament->slug" icon="bi-controller">
        @if($tournament->format == TournamentFormat::Team)
            {{ __('Teams') }}
        @else
            {{ __('Players') }}
        @endif
    </x-sidebar.item>
</x-sidebar.group>

<x-sidebar.group>
    <x-sidebar.item route="web.tournaments.mappools" :route-params="$tournament->slug" icon="bi-music-note-beamed">
        {{ __('Mappool') }}
    </x-sidebar.item>

    {{--    <a href="#" class="list-group-item">--}}
    {{--        <i class="bi bi-journal"></i>--}}
    {{--        {{ __('Bracket') }}--}}
    {{--    </a>--}}

{{--    <x-sidebar.item route="web.tournaments.schedules" :route-params="$tournament->slug" icon="bi-journal">--}}
{{--        {{ __('Schedules') }}--}}
{{--    </x-sidebar.item>--}}

    <x-sidebar.item route="web.tournaments.stages.index" :route-params="$tournament->slug" icon="bi-view-list">
        {{ __('Stages') }} / {{ __('Schedules') }}
    </x-sidebar.item>
</x-sidebar.group>

{{--<x-sidebar.group>--}}
{{--    <x-sidebar.item icon="bi-shield-fill">--}}
{{--        {{ __('Apply for Staff') }}--}}
{{--    </x-sidebar.item>--}}
{{--</x-sidebar.group>--}}

<x-sidebar.group>
    <x-sidebar.item route="web.tournaments.staff.index" :route-params="$tournament->slug" icon="bi-people-fill">
        {{ __('Staff') }}
    </x-sidebar.item>
</x-sidebar.group>

@can('update', $tournament)
    <x-sidebar.group>
        <x-sidebar.item route="web.tournaments.edit" :route-params="$tournament->slug" icon="bi-wrench">
            {{ __('Settings') }}
        </x-sidebar.item>
    </x-sidebar.group>
@endcan
