@extends('parts.base')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                @include('parts.alerts')
                <div class="card">
                    <h2>{{ $text??"" }}</h2>
                </div>
            </div>
        </div>
    </div>
@endsection
