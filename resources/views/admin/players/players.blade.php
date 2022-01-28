@extends('admin.parts.base')

@section('content')
    <div class="container mt-3">
        <div class="card mb-3">
            <div class="card-header">{{ __("Search") }}</div>
            <div class="card-body">
                {{ Form::open(['url' => route('admin.players'), 'method' => 'GET']) }}
                <div class="input-group">
                    {{ Form::text('search', $search??"", ['class' => 'form-control', 'placeholder' => 'Search for player...']) }}
                    <button type="submit" class="btn btn-primary">{{ __("Search") }}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="card">
            <table class="table table-dark table-qot table-hover">
                <thead>
                <tr>
                    <th style="width: 20%;">{{ __('Player') }}</th>
                    <th style="width: 20%;">{{ __('Discord') }}</th>
                    <th>{{ __('Timezone') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($players as $player)
                    <tr>
                        <td>
                            <a href="https://quavergame.com/user/{{ $player->user->quaver_user_id }}" target="_blank">
                                {{ $player->user->quaver_username }}
                            </a>
                        </td>
                        <td>
                            <a href="javascript:void(0)"
                               onclick="copyToClipboard(this)"
                               data-bs-toggle="tooltip"
                               data-bs-placement="top" title="{{ __('Click to copy') }}">
                                {{ $player->user->discord_username }}
                            </a> -
                            <a href="javascript:void(0)"
                               onclick="copyToClipboard(this, '{{ '<@' . $player->user->discord_user_id . '>' }}')"
                               data-bs-toggle="tooltip"
                               data-bs-placement="top" title="{{ __('Click to copy') }}">
                                ID
                            </a>
                        </td>
                        <td>
                            {{ $player->data['timezone'] }}
                        </td>
                        <td>
                            {{ $player->status }}
                        </td>
                        <td>
                            @if($player->status)
                                {{ Form::open(['url' => route('admin.players.status.update', $player->user_id)]) }}
                                <button class="btn btn-danger btn-sm">Remove</button>
                                {{ Form::close() }}
                            @else
                                {{ Form::open(['url' => route('admin.players.status.update', $player->user_id)]) }}
                                <button class="btn btn-info btn-sm">Allow</button>
                                {{ Form::close() }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="card-body">
                {{ $players->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function copyToClipboard(element, text = null) {
            $(element).attr('data-bs-original-title', "{{ __('Copied!') }}").tooltip('show');
            let $temp = $("<input>");
            $("body").append($temp);
            if (!text) $temp.val($(element).text().trim()).select();
            else $temp.val(text).select();
            document.execCommand("copy");
            $temp.remove();

            setInterval(function () {
                $(element).attr('data-bs-original-title', "{{ __('Click to copy') }}").tooltip('show');
            }, 1000);
        }
    </script>
@endpush
