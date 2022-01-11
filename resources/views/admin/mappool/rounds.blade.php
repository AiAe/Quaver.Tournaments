@extends('admin.parts.base')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">{{ __('Create round') }}</div>
            <div class="card-body">
                {{ Form::open(['url' => route('admin.mappool.roundsPOST')]) }}
                <div class="mt-3">
                    <label class="form-label">{{ __('Round name') }}</label>
                    {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Round of 128']) }}
                </div>

                <div class="mt-3">
                    <label class="form-label">{{ __('Position') }}</label>
                    {{ Form::text('position', '', ['class' => 'form-control', 'placeholder' => '1']) }}
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary btn-sm">{{ __('Submit') }}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">{{ __('Mappool rounds (drag to reorder)') }}</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-white">
                        <thead>
                        <tr>
                            <th>{{ __('Round') }}</th>
                            <th style="width: 10%">{{ __('Maps') }}</th>
                            <th style="width: 10%">{{ __('Order') }}</th>
                            <th style="width: 20%">{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody id="better-sort-boxes">
                        @foreach($rounds as $round)
                            <tr data-id="{{ $round['id'] }}" data-trigger="hover">
                                <td>
                                    <a href="{{ route('admin.mappool.roundSelect', $round['id']) }}">
                                        {{ $round['name'] }}
                                    </a>
                                </td>
                                <td>{{ $round->maps->count() }}</td>
                                <td class="position">{{ $round['position'] }}</td>
                                <td>
                                    {{ Form::open(['url' => route('admin.mappool.rounds.statusPOST', $round['id']), 'class' => 'd-inline']) }}
                                    @if($round->status)
                                        <button type="submit"
                                                class="btn btn-success btn-sm">{{ __('Enabled') }}</button>
                                    @else
                                        <button type="submit"
                                                class="btn btn-danger btn-sm">{{ __('Disabled') }}</button>
                                    @endif
                                    {{ Form::close() }}
                                    {{ Form::open(['url' => route('admin.mappool.rounds.deletePOST', $round['id']), 'class' => 'd-inline']) }}
                                    <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
                axios.post('{{ route('admin.mappool.rounds.positionsPOST') }}', {
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
