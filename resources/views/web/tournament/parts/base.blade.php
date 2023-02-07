@extends('web.layout.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('web.tournament.components.sidebar')
            </div>

            <div class="col-lg-9">
                @yield('section')
            </div>
        </div>
    </div>
@endsection
