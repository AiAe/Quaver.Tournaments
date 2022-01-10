@extends('admin.parts.base')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">Submit map</div>
            <div class="card-body">
                {{ Form::open(['url' => route('admin.mappool.roundSelectSave', $round['id'])]) }}
                <div>
                    <label class="form-label">{{ __('Map URL') }}</label>
                    {{ Form::text('map', '', ['class' => 'form-control', 'placeholder' => 'https://quavergame.com/mapset/map/661']) }}
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mt-3">
                            <label class="form-label">{{ __('Category') }}</label>
                            {{ Form::select('category', arrayCombine(\App\Rules\MappoolCategoryValidation::$categories), null, ['class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mt-3">
                            <label class="form-label">{{ __('Type') }}</label>
                            {{ Form::select('type', arrayCombine(\App\Rules\MappoolTypeValidation::$types), null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="mt-3">
                            <label class="form-label">{{ __('Rate') }}</label>
                            {{ Form::select('rate', arrayCombine(\App\Rules\MappoolRateValidation::$rates), "1x", ['class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="mt-3">
                            <label class="form-label">{{ __('Mods') }}</label>
                            {{ Form::select('mods', arrayCombine(\App\Rules\MappoolModsValidation::$mods), null, ['class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="mt-3">
                            <label class="form-label">{{ __('Offset') }}</label>
                            {{ Form::text('offset', 0, ['class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="mt-3">
                            <label class="form-label">Difficulty Rating (if rate is not 1x)</label>
                            {{ Form::text('overwrite_difficulty_rating', null, ['class' => 'form-control']) }}
                        </div>
                    </div>

                    {{--                    <div class="col-lg-3">--}}
                    {{--                        <div class="mt-3">--}}
                    {{--                            <label class="form-label">{{ __('LN%') }}</label>--}}
                    {{--                            {{ Form::text('lns', 0, ['class' => 'form-control']) }}--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>

                <div class="mt-3">
                    <label class="form-label">{{ __('Position') }}</label>
                    {{ Form::text('position', 0, ['class' => 'form-control']) }}
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary btn-sm">{{ __('Submit') }}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">Maps (drag to reorder)</div>
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
                    <th>Order</th>
                </tr>
                </thead>
                <tbody id="better-sort-boxes">
                @foreach($maps as $map)
                    <tr data-id="{{ $map['id'] }}" data-trigger="hover" style="background-size: cover; background-image:
                        linear-gradient(rgba(0, 0, 0, 0.70), rgba(0, 0, 0, 0.70)),
                        url('https://cdn.quavergame.com/mapsets/{{ $map->map['mapset_id'] }}.jpg');">
                        <td>{{ $map['category'] }}</td>
                        <td>{{ $map['type'] }}</td>
                        <td>
                            <a href="{{ route('quaverMap', $map->map['id']) }}" target="_blank" class="text-white">
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
                        <td class="position-relative">
                            {{ $map['position'] }}
                            <div class="table-delete">
                                {{ Form::open(['url' => route('admin.mappool.roundSelectDeletePOST', $map->id)]) }}
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                {{ Form::close() }}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function (event) {
            $('[data-toggle="popover"]').popover();

            Sortable.create(document.getElementById('better-sort-boxes'), {
                draggable: 'tr',
                dragoverBubble: false,
                handle: "tr",
                chosenClass: 'row-block-item-chosen-handle',
                onStart: function (evt) {
                    $('[data-toggle="popover"]').popover('dispose')
                },
                onAdd: function (/**Event*/ evt) {
                },
                onEnd: function (evt) {
                    resortbetter();
                    $('[data-toggle="popover"]').popover();
                },
            });

            function resortbetter() {
                var result = [];
                var key = 1;
                $('#better-sort-boxes > tr').each(function () {
                    result[key] = $(this).data('id');
                    $(this).find('.position').text(key);
                    key++;
                });
                console.log(result);
                axios.post('{{ route('admin.mappool.roundSelectPositionsSave', $round) }}', {
                    orders: result
                }).then(function (response) {
                    console.log(response);
                }).catch(function (error) {
                    console.log(error);
                });
            }
        });
    </script>
@endpush
