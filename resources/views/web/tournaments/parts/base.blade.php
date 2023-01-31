@extends('web.layout.base')

@section('content')
    <div class="container-fluid px-0">
        <div class="row flex-nowrap gx-0">
            <div class="col-auto px-0">
                @include('web.tournaments.components.sidebar')
            </div>

            <main class="col ps-0 pt-2">
                @yield('section')
            </main>
        </div>
    </div>
@endsection
