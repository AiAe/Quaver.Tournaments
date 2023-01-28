@extends('web.layout.base')

@section('content')
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto px-0">
                @include('web.tournaments.components.sidebar')
            </div>

            <main class="col ps-md-2 pt-2">
                @yield('section')
            </main>
        </div>
    </div>
@endsection
