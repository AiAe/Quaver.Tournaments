@forelse($matches as $date => $timestamps)
    @php($parsed_date = \Carbon\Carbon::parse($date))
    <div class="round-name d-flex align-items-center">
        <span></span>{{ $parsed_date->format('F j l') }}
    </div>

    @foreach($timestamps as $match)
        <div class="card mb-2">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="m-0 p-0">Lobby {{ $match->label }}</h5>
                        <p class="m-0 p-0">Lobby {{ $match->timestamp }} - Player {{ $loggedUser->convertTime($match->timestamp) }}</p>
                        <p class="m-0 p-0">Referee: Placeholder</p>
                    </div>
                    <div>
                        <div class="d-flex flex-column gap-1 align-items-center">
                            @if($loggedUserTeamCaptain)
                                <livewire:tournaments.match-participant
                                    class="d-flex justify-content-end mt-2"
                                    :match="$match"
                                    wire:key="match-{{ $match->id }}"></livewire:tournaments.match-participant>
                            @endif
{{--                            @can('editStaff', $match)--}}
{{--                                    <a class="btn btn-warning btn-sm" href="#tournamentMatchAssignment-{{ $match->id }}"--}}
{{--                                       data-bs-toggle="modal"--}}
{{--                                       data-bs-target="#tournamentMatchAssignment-{{ $match->id }}">--}}
{{--                                        {{ __('Staff') }}--}}
{{--                                    </a>--}}
{{--                                @push('modals')--}}
{{--                                    <livewire:tournaments.match-assignment :match="$match">--}}
{{--                                    </livewire:tournaments.match-assignment>--}}
{{--                                @endpush--}}
{{--                            @endcan--}}
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    @php($participants = $match->ffaParticipants)
                    <div class="table-responsive">
                        <table class="table table-bordered table-dark mb-0">
                            <tr>
                                @for($i = 0; $i < 5; $i++)
                                    <td>{{ $participants[$i]['name'] ?? "-" }}</td>
                                @endfor
                            </tr>
                            <tr>
                                @for($i = 5; $i < 10; $i++)
                                    <td>{{ $participants[$i]['name'] ?? "-" }}</td>
                                @endfor
                            </tr>
                            <tr>
                                @for($i = 10; $i < 15; $i++)
                                    <td>{{ $participants[$i]['name'] ?? "-" }}</td>
                                @endfor
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@empty
    <div class="card mb-2">
        <div class="card-body">
            <div class="row">
                <span>{{__('No matches so far...')}}</span>
            </div>
        </div>
    </div>
@endforelse
