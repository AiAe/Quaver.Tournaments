@extends('web.tournaments.parts.base')

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>{{ $round->name }}</h1>
        </header>
    </div>
@endpush

@section('section')

    <div class="card">
        <div class="card-header">
            Info
        </div>
        {{-- TODO: Description with best of, number of bans, etc --}}
        <p>Best of 7, 2 bans per player/team</p>
    </div>
@endsection
