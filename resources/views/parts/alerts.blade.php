@if(session()->has('success') || session()->has('error') || (Auth::user() && !Auth::user()->discord_user_id))
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(Auth::user() && !Auth::user()->discord_user_id)
        <div class="alert alert-danger">
            {{ __('You have not yet connected your Discord account!') }}
        </div>
    @endif
@endif
