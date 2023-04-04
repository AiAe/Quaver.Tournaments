@php use App\Enums\StaffRole; @endphp
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
        <div class="card-header">
            {{ $title }}
        </div>

        <div class="card-body">
            {{ Form::open(['url' => route('web.tournaments.staff.store', $tournament->slug)]) }}
            <div class="form-group">
                <label class="form-label">{{ __('Username') }}</label>
                {{ Form::text('username', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group mt-2">
                <label class="form-label">{{ __('Role') }}</label>
                {{ Form::select('role', StaffRole::array(), null, ['class' => 'form-control']) }}
            </div>

            <div class="d-flex justify-content-end mt-2">
                {{ Form::button(__('Save'), ['class' => 'btn btn-primary btn-sm', 'type' => 'submit']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
