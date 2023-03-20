<div>
    <div class="row mt-2">
        @forelse($maps as $map)
            @dump($map->toArray())
            @php($m = $map->map)
            <div class="col-lg-12 mb-2">
                <div class="map position-relative">
                    <div class="mapset-cover d-flex justify-content-between align-items-center"
                         style="background: linear-gradient(90deg, rgba(23, 23, 23, 0.93) 52.58%, rgba(36, 36, 36, 0.4) 100%),
                         url('https://cdn.quavergame.com/mapsets/{{ $m->quaver_mapset_id }}.jpg'); background-size: cover;">
                        <div>
                            <div>{{ $m->artist }} - {{ $m->title }}</div>
                            <div>{{ $m->difficulty_name }} - {{ $m->difficulty_rating }}</div>
                        </div>
                        <div>
                            @if($map->mods)
                                <img src="{{ asset('assets/img/mods/'.$map->mods.'.svg') }}">
                            @endif
                        </div>
                    </div>
                    <div class="row map-info-2">
                        <div class="col-lg-8">
                            {{ __('Category') }}: <span>{{ $map->category }} - {{ $map->sub_category }}</span>
                        </div>
                        <div class="col-lg-4">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <i class="bi bi-plus-slash-minus"></i> <span>{{ $map->offset }}</span>
                                </div>
                                <div>
                                    <i class="bi bi-clock-fill"></i> <span>{{ $m->length }}</span>
                                </div>
                                <div>
                                    <i class="bi bi-speedometer2"></i> <span>{{ $m->bpm }} BPM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ $m->quaverUrl() }}" class="stretched-link" target="_blank"></a>
                </div>
            </div>
        @empty
            <div class="col-lg-12">
                {{ __('No maps...') }}
            </div>
        @endforelse
    </div>
</div>
