@extends('parts.base')

@section('content')
    <div class="container mt-3">
        @foreach($rounds as $round)
            <div class="card mt-3">
                <div class="card-header">
                    {{ $round->name }}
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table text-white text-center table-qot-mappool" style="font-size: 15px">
                            <thead>
                            <tr>
                                <th>Category</th>
                                <th>Type</th>
                                <th>Map</th>
                                <th>Rate</th>
                                <th>Mods</th>
                                <th>Offset</th>
                                <th>Rating</th>
                                <th>Length</th>
                                <th>BPM</th>
                            </tr>
                            </thead>
                            <tbody id="better-sort-boxes">
                            @foreach($round->maps as $map)
                                <tr data-id="{{ $map['id'] }}" data-trigger="hover"
                                    style="background-size: cover; background-image:
                                        linear-gradient(rgba(0, 0, 0, 0.70), rgba(0, 0, 0, 0.70)),
                                        url('https://cdn.quavergame.com/mapsets/{{ $map->map['mapset_id'] }}.jpg');">
                                    <td>{{ $map['category'] }}</td>
                                    <td>{{ $map['type'] }}</td>
                                    <td>
                                        <a href="{{ route('quaverMap', $map->map['id']) }}" target="_blank"
                                           class="text-white">
                                            {{ $map->map['artist'] . ' - ' . $map->map['title'] }}
                                            [{{ $map->map['difficulty_name'] }}]
                                        </a>
                                    </td>
                                    <td>{{ $map->data['rate'] }}</td>
                                    <td>{{ $map->data['mods'] }}</td>
                                    <td>{{ $map->data['offset'] }}</td>
                                    <td>{{ number_format($map->map['difficulty_rating'], 2) }}</td>
                                    <td>{{ date("i:s", $map->map['length'] / 1000) }}</td>
                                    <td>{{ $map->map['bpm'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
