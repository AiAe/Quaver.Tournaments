<div class="stage">
    <div class="stage-name d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <span></span> {{$stage->name}}
        </div>
    </div>
    <div class="stage-body">
        <div class="row">
            <div class="col-lg-6">
                {{ $stage->stage_text??"" }}
            </div>
            <div class="col-lg-6">
                @forelse($stage->rounds as $round)
                    <div class="round position-relative">
                        <div class="d-flex justify-content-between align-items-center">
                            {{ $round->name }}

                            <div>
                                {{ $round->starts_at->format('d M') }} - {{ $round->ends_at->format('d M') }}

                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>

                        <a class="stretched-link"
                           href="{{route('web.tournaments.rounds.show', ['tournament' => $tournament, 'round' => $round])}}"></a>
                    </div>
                @empty
                    <div class="col-lg-12">
                        {{ __('No rounds...') }}
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
