@extends('web.layout.base')

@push('seo')
    {!! seo()->for($SEOData) !!}
@endpush

@section('content')
    <div class="container">
        <header class="page-cover">
            <h1>{{ __('Quaver Tournaments') }}</h1>
        </header>

        <div class="card mt-3">
            <div class="card-body text-center">
                <h1>
                    Welcome to <strong>Quaver Tournaments</strong>!
                </h1>

                <p>
                    Quaver Tournaments is dedicated to hosting exciting tournaments for people who love the thrill of
                    competition, for all skill levels from beginners to seasoned pros.
                    <br>
                    No matter whether you're looking to play, spectate or maybe even help out as staff, this is the
                    right place to go.
                </p>

                <p>
                    So what are you waiting for? Join the Quaver community today and start competing in some of the most
                    thrilling and engaging tournaments around.
                </p>

                <div class="d-flex justify-content-center">
                    <a href="{{ route('web.tournaments.index') }}"
                       class="btn btn-primary btn-sm">{{ __('Browse Tournaments') }}</a>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-6">
                <div class="card text-center">
                    <div class="card-header">
                        {{ __('Upcoming Tournaments') }}
                    </div>
                    <div class="card-body">
                        {{ __('There are currently no upcoming tournaments!') }}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card text-center">
                    <div class="card-header">
                        {{ __('Ongoing Tournaments') }}
                    </div>
                    <div class="card-body">
                        {{ __('There are currently no ongoing tournaments!') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Are you interested in hosting a Quaver Tournament?</h5>

                        <p class="mt-3">
                            We offer a lot of features to help plan and execute tournaments with ease. <br>
                            Whether you're looking to host a small tournament or a large-scale competition, we have
                            everything to make it a success.<br>
                        </p>

                        <p>
                            The platform is still work in progress, but we plan to extend it even more in the coming
                            months!
                        </p>

                        <div class="d-flex justify-content-center">
                            <a href="mailto:me@aiae.dev"
                               class="btn btn-primary btn-sm">{{ __('Request access') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
