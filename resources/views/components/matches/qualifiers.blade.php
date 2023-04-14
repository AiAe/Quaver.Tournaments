@forelse($matches as $date => $timestamps)
    <div class="round-name d-flex align-items-center">
        <span></span>{{ \Carbon\Carbon::parse($date)->format('F j l') }}
    </div>

    @foreach($timestamps as $match)
        <div class="card mb-2">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Lobby {{$match->label}}</h5>
                        <p>Referee: Placeholder</p>
                    </div>
                    <div>
                        @if($loggedUserTeamCaptain)
                            <livewire:tournaments.match-participant
                                class="d-flex justify-content-end mt-2"
                                :match="$match"
                                wire:key="match-{{ $match->id }}"></livewire:tournaments.match-participant>
                        @endif
                    </div>
                </div>
                <div class="row">
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
