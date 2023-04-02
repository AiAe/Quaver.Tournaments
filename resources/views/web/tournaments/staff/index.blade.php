@extends('web.tournaments.parts.base')

@push('seo')
    {!! seo()->for($tournament) !!}
@endpush

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>{{ $title }}</h1>
        </header>
    </div>
@endpush

@section('section')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>{{ $title }}</div>
            <div>
                @can('update', $tournament)
                    <a href="{{ route('web.tournaments.staff.create', $tournament->slug) }}"
                       class="btn btn-primary btn-sm">{{ __('Create/Update') }}</a>
                @endcan
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-dark">
                <thead>
                <tr>
                    <th style="width: 25%;">{{ __('Role') }}</th>
                    <th>{{ __('User') }}</th>
                    @can('update', $tournament)
                        <th style="width: 20%;">{{ __('Actions') }}</th>user
                    @endcan
                </tr>
                </thead>
                <tbody>
                @forelse($tournament->staff as $staff)
                    <tr>
                        <td>{{ $staff->staff_role->name() }}</td>
                        <td>
                            <a href="{{ $staff->user->quaverUrl() }}" target="_blank" rel="noreferrer">
                                {{ $staff->username }}
                            </a>
                        </td>
                        @can('update', $tournament)
                            <td>
                                {{ Form::open(['url' => route('web.tournaments.staff.destroy', ['tournament' => $tournament, 'staff' => $staff->id]), 'class' => 'd-flex']) }}
                                @method('DELETE')
                                {{ Form::submit(__('Kick'), ['class' => 'btn btn-danger btn-sm']) }}
                                {{ Form::close() }}
                            </td>
                        @endcan
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">{{ __('There is currently no Staff') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
