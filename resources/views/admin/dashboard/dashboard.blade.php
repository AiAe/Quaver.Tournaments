@extends('admin.parts.base')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">Users</div>
                    <div class="card-body text-center">
                        <h4>{{ \App\Models\User::query()->count()|number_format(0) }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">Tourney signups</div>
                    <div class="card-body text-center">
                        <h4>{{ \App\Models\Forms::query()->where('type', \App\Models\Forms::TYPE['player'])->count()|number_format(0) }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">Suggested maps</div>
                    <div class="card-body text-center">
                        <h4>{{ \App\Models\Mapsuggestions::query()->count()|number_format(0) }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">Staff applications</div>
                    <div class="card-body text-center">
                        <h4>{{ \App\Models\Forms::query()->where('type', \App\Models\Forms::TYPE['staff'])->count()|number_format(0) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
