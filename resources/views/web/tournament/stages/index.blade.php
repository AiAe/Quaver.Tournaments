@extends('web.tournament.parts.base')

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>{{ $title }}</h1>
        </header>
    </div>
@endpush

@section('section')
    @forelse($tournament->stages as $stage)
        <x-stages.card :stage="$stage"/>
    @empty
        <div class="card">
            <p>No stages...</p>
        </div>
    @endforelse
@endsection
