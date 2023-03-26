@extends('web.tournaments.parts.base')

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

        <div class="table-responsive">
            <table class="table table-hover table-dark table-link">
                <thead>
                <tr>
                    <th style="width: 25%;">{{ __('Role') }}</th>
                    <th>{{ __('User') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tournament->staff as $user)
                    <tr data-route="{{ $user->quaverUrl() }}" data-blank="yes">
                        <td>{{ $user->pivot->staff_role->name() }}</td>
                        <td>{{ $user->username }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">{{ __('There is currently no Staff') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
