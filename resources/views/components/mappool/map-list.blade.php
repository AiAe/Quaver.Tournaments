<div>
    <div class="row mt-2">
        @forelse($maps as $map)
            @php($m = $map->map)
            <div class="col-lg-12 mb-2">
                <div class="map position-relative">
                    <div class="mapset-cover d-flex justify-content-between align-items-center"
                         style="background: linear-gradient(90deg, rgba(23, 23, 23, 0.93) 52.58%, rgba(36, 36, 36, 0.4) 100%),
                         url('https://cdn.quavergame.com/mapsets/{{ $m->quaver_mapset_id }}.jpg'); background-size: cover;">
                        <div>
                            <div>{{ $m->artist }} - {{ $m->title }}</div>
                            <div>{{ $m->difficulty_name }} - {{ number_format(($map->modded_difficulty) ?: $m->difficulty_rating, 2) }}</div>
                        </div>
                        <div>
                            @if($map->mods)
                                @php($mods = explode(",", $map->mods))
                                @foreach($mods as $mod)
                                    <img src="{{ asset('assets/img/mods/'.$mod.'.svg') }}">
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="row map-info-2">
                        <div class="col-lg-7">
                            {{ __('Category') }}: <span>{{ $map->category }} - {{ $map->sub_category }}</span>
                        </div>
                        <div class="col-lg-5">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <i class="bi bi-plus-slash-minus"></i> <span>{{ $map->offset??0 }}</span>
                                </div>
                                <div>
                                    <i class="bi bi-clock-fill"></i>
                                    <span>{{ \Carbon\CarbonInterval::milliseconds($m->length)->cascade()->forHumans(null, true, 2) }}</span>
                                </div>
                                <div>
                                    <i class="bi bi-speedometer2"></i> <span>{{ ($map->modded_bpm) ?: $m->bpm }} BPM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ $m->quaverUrl() }}" class="stretched-link" target="_blank"></a>
                </div>
            </div>
        @empty
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body text-center">
                        {{ __('There are currently no maps') }}
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
