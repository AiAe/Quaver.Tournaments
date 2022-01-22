@extends('admin.parts.base')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">{{ __('Users') }}</div>
                    <div class="card-body text-center">
                        <h4>{{ \App\Models\User::query()->count()|number_format(0) }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">{{ __('Tourney signups') }}</div>
                    <div class="card-body text-center">
                        <h4>{{ \App\Models\Player::query()->where('status', '=', 1)->count()|number_format(0) }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">{{ __('Suggested maps') }}</div>
                    <div class="card-body text-center">
                        <h4>{{ \App\Models\Mapsuggestion::query()->count()|number_format(0) }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">{{ __('Staff applications') }}</div>
                    <div class="card-body text-center">
                        <h4>{{ \App\Models\Form::query()->where('type', \App\Models\Form::TYPE['staff'])->count()|number_format(0) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
