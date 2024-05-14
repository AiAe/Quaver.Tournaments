@extends('web.tournaments.parts.base')

@push('seo')
    {!! seo()->for(new \RalphJSmit\Laravel\SEO\Support\SEOData(title: $title . " :: " . $tournament->name)) !!}
@endpush

@push('cover')
    <div class="col-lg-12">
        <header class="page-cover smaller">
            <h1>{{ $title }}</h1>
        </header>
    </div>
@endpush

@section('section')
    <style>
        .table a {
            text-decoration: none;
            display: inline-block;
        }

        .table a div {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 5px;
        }
    </style>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>{{ $title }}</div>
            <div>
                @can('update', $tournament)
                    <a href="{{ route('web.tournaments.staff.create', $tournament->slug) }}"
                       class="btn btn-primary btn-sm">{{ __('Create') }}</a>
                @endcan
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-dark">
                <thead>
                <tr>
                    <th style="width: 15%;">{{ __('Position') }}</th>
                    <th>{{ __('Member(s)') }}</th>
                </tr>
                </thead>
                <tbody>
                @php($staff_enums = \App\Enums\StaffRole::class)
                @foreach(\App\Enums\StaffRole::names() as $key => $name)
                    @php($role = $staff_enums::from($key))
                    @php($members = collect($tournament->staff)->where('staff_role', $role))
                    <tr>
                        <td> {{ $role->name() }}</td>
                        <td>
                            @if(count($members))
                                @foreach($members as $member)
                                    <a href="{{ $member->user->quaverUrl() }}" target="_blank">
                                        <div>
                                            <img src="{{ countryFlag($member->user->country) }}"
                                                 alt="{{ $member->user->country }}" height="14">
                                            {{ $member->user->username }}
                                        </div>
                                    </a>
                                    @can('update', $tournament)
                                        {{ Form::open(['url' => route('web.tournaments.staff.destroy', ['tournament' => $tournament, 'staff' => $member->id]), 'class' => 'd-inline-block']) }}
                                        @method('DELETE')
                                        <a href="#" class="text-danger" onclick="this.closest('form').submit();return false;"><i class="bi bi-x"></i></a>
                                        {{ Form::close() }}
                                    @endcan
                                @endforeach
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
