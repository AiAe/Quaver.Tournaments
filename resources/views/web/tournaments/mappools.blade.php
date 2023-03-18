@php use App\Enums\TournamentStageFormat; @endphp
@extends('web.tournaments.parts.base')

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>Mappools</h1>
        </header>
    </div>
@endpush

@section('section')
    @forelse(
        $tournament->stages()
            ->whereNot('stage_format', TournamentStageFormat::Registration)
            ->get()
            ->flatMap
            ->rounds
        as $round
    )
        {{-- TODO: Implement mappools list design? probably not needed as long as the component works properly --}}
        <div class="card">
            <div class="card-header">
                {{$round->name}}
            </div>
            <x-mappool.map-list :maps="$round->maps"/>
        </div>
    @empty
        <div class="card">
            No mappools...
        </div>
    @endforelse
@endsection
