@extends('admin.parts.base')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <table class="table table-dark table-qot table-hover">
                <thead>
                <tr>
                    <th style="width: 20%;">Player</th>
                    <th style="width: 20%;">Discord</th>
                    <th>Role</th>
                    <th>Registered</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <a href="https://quavergame.com/user/{{ $user->quaver_user_id }}" target="_blank">
                                {{ $user->quaver_username }}
                            </a>
                        </td>
                        <td>
                            <a href="javascript:void(0)"
                               onclick="copyToClipboard(this)"
                               data-bs-toggle="tooltip"
                               data-bs-placement="top" title="Click to copy">
                                {{ $user->discord_username }}
                            </a> -
                            <a href="javascript:void(0)"
                               onclick="copyToClipboard(this, '{{ '<@' . $user->discord_user_id . '>' }}')"
                               data-bs-toggle="tooltip"
                               data-bs-placement="top" title="Click to copy">
                                ID
                            </a>
                        </td>
                        <td>
                            {{ $user->getRole() }}
                        </td>
                        <td>
                            {{ $user->created_at }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="card-body">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function copyToClipboard(element, text = null) {
            $(element).attr('data-bs-original-title', "Copied!").tooltip('show');
            let $temp = $("<input>");
            $("body").append($temp);
            if (!text) $temp.val($(element).text().trim()).select();
            else $temp.val(text).select();
            document.execCommand("copy");
            $temp.remove();

            setInterval(function () {
                $(element).attr('data-bs-original-title', "Click to copy").tooltip('show');
            }, 1000);
        }
    </script>
@endpush
