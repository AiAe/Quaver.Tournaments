<div>
    <div class="tournament position-relative">
        <h1>{{ $tournament->name }}</h1>

        <div class="row">
            <div class="col-lg-12 col-md-12 d-flex align-items-center">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 tournament-cover">
                        <img src="{{ asset('assets/img/cover_l_q.png') }}" class="img-fluid"
                             width="610" height="150" loading="lazy">
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 d-flex align-items-center text-center">
                <x-tournament.details :tournament="$tournament"/>
            </div>
        </div>
    </div>

</div>
