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
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Map') }}</th>
                                <th>{{ __('Rate') }}</th>
                                <th>{{ __('Mods') }}</th>
                                <th>{{ __('Offset') }}</th>
                                <th>{{ __('Rating') }}</th>
                                <th>{{ __('Length') }}</th>
                                <th>{{ __('BPM') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($round->maps as $map)
                                <tr data-id="{{ $map['id'] }}"
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
