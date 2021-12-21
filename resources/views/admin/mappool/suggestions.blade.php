@extends('admin.parts.base')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <table class="table table-dark table-qot table-hover">
                <thead>
                <tr>
                    <th style="width: 10%">Suggested by</th>
                    <th>Map</th>
                    <th style="width: 15%;">Map Type</th>
                    <th style="width: 15%;">Intended stage</th>
                    <th style="width: 5%">Suggested</th>
                </tr>
                </thead>
                <tbody>
                @foreach($maps as $map)
                    <tr>
                        <td>
                            <a href="https://quavergame.com/user/{{ $map->user->quaver_user_id }}" target="_blank">
                                {{ $map->user->quaver_username }}
                            </a>
                        </td>
                        <td>
                            <a href="https://quavergame.com/mapset/map/{{ $map['map']['id'] }}" target="_blank">
                                {{ $map['map']['artist'] }} - {{ $map['map']['title'] }}
                            </a>
                        </td>
                        <td>
                            {{ $map['map_type'] }}
                        </td>
                        <td>
                            {{ $map['intended_stage'] }}
                        </td>
                        <td>
                            {{ $map['total'] }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="card-body">
                {{ $maps->links() }}
            </div>
        </div>
    </div>
@endsection
