@extends('web.tournament.parts.base')

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>{{ $title }}</h1>
        </header>
    </div>
@endpush

@section('section')
    <div class="card">
        <div class="card-header">
            {{ $title }}
        </div>

        {{-- TODO: insert design here, sort/group by staff role? --}}
        <div class="table-responsive">
            <table class="table table-hover table-dark table-link">
                <thead>
                <tr>
                    <th style="width: 10%;">{{ __('#') }}</th>
                    <th>{{ __('Role') }}</th>
                    <th>{{ __('User') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tournament->staff as $user)
                    <tr data-route="{{$user->quaverUrl()}}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $user->pivot->staff_role->name() }}</td>
                        <td>{{$user->username}}</td>
                    </tr>
                @empty
                    <tr>
                        <td>No staff...?</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
