@extends('parts.base')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">{{ __('Map Suggestion') }}</div>
                    <div class="card-body">
                        {{ Form::open(['url' => route('mapsSuggestionPOST')]) }}
                        <div class="mt-3">
                            <label class="form-label">{{ __('Map link (4K only)') }}</label>
                            {{ Form::text('map', '', ['class' => 'form-control']) }}
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-3">
                                    <label class="form-label">{{ __('Map type') }}</label>
                                    <div class="form-check">
                                        {{ Form::radio('type', 'SV', false, ['class' => 'form-check-input', 'id' => 'SV']) }}
                                        <label class="form-check-label" for="SV">
                                            SV
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        {{ Form::radio('type', 'LN', false, ['class' => 'form-check-input', 'id' => 'LN']) }}
                                        <label class="form-check-label" for="LN">
                                            LN
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        {{ Form::radio('type', 'Speed', false, ['class' => 'form-check-input', 'id' => 'Speed']) }}
                                        <label class="form-check-label" for="Speed">
                                            Speed
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        {{ Form::radio('type', 'Jack', false, ['class' => 'form-check-input', 'id' => 'Jack']) }}
                                        <label class="form-check-label" for="Jack">
                                            Jack
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        {{ Form::radio('type', 'Accuracy', false, ['class' => 'form-check-input', 'id' => 'Accuracy']) }}
                                        <label class="form-check-label" for="Accuracy">
                                            Accuracy
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        {{ Form::radio('type', 'Technical', false, ['class' => 'form-check-input', 'id' => 'Technical']) }}
                                        <label class="form-check-label" for="Technical">
                                            Technical
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        {{ Form::radio('type', 'Hybrid', false, ['class' => 'form-check-input', 'id' => 'Hybrid']) }}
                                        <label class="form-check-label" for="Hybrid">
                                            Hybrid
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        {{ Form::radio('type', 'Tiebreaker', false, ['class' => 'form-check-input', 'id' => 'Tiebreaker']) }}
                                        <label class="form-check-label" for="Tiebreaker">
                                            Tiebreaker
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        {{ Form::radio('type', 'Other', false, ['class' => 'form-check-input', 'id' => 'TOther']) }}
                                        <label class="form-check-label" for="TOther">
                                            Don't know
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-3">
                                    <label class="form-label">{{ __('Intended stage') }}</label>
                                    <div class="form-check">
                                        {{ Form::radio('stage', 'Round of 128', false, ['class' => 'form-check-input', 'id' => 'ro128']) }}
                                        <label class="form-check-label" for="ro128">
                                            Round of 128
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        {{ Form::radio('stage', 'Round of 64', false, ['class' => 'form-check-input', 'id' => 'ro64']) }}
                                        <label class="form-check-label" for="ro64">
                                            Round of 64
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        {{ Form::radio('stage', 'Round of 32', false, ['class' => 'form-check-input', 'id' => 'ro32']) }}
                                        <label class="form-check-label" for="ro32">
                                            Round of 32
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        {{ Form::radio('stage', 'Round of 16', false, ['class' => 'form-check-input', 'id' => 'ro16']) }}
                                        <label class="form-check-label" for="ro16">
                                            Round of 16
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        {{ Form::radio('stage', 'Quarterfinals', false, ['class' => 'form-check-input', 'id' => 'Quarterfinals']) }}
                                        <label class="form-check-label" for="Quarterfinals">
                                            Quarterfinals
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        {{ Form::radio('stage', 'Semifinals', false, ['class' => 'form-check-input', 'id' => 'Semifinals']) }}
                                        <label class="form-check-label" for="Semifinals">
                                            Semifinals
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        {{ Form::radio('stage', 'Finals', false, ['class' => 'form-check-input', 'id' => 'Finals']) }}
                                        <label class="form-check-label" for="Finals">
                                            Finals
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        {{ Form::radio('stage', 'Grand Finals', false, ['class' => 'form-check-input', 'id' => 'GrandFinals']) }}
                                        <label class="form-check-label" for="GrandFinals">
                                            Grand Finals
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        {{ Form::radio('stage', 'Other', false, ['class' => 'form-check-input', 'id' => 'SOther']) }}
                                        <label class="form-check-label" for="SOther">
                                            Don't know
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label
                                class="form-label">{{ __('Additional Information (describe the map, tell us why this map etc.)') }}</label>
                            {{ Form::textarea('additional_information', '', ['class' => 'form-control', 'rows' => 3]) }}
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary btn-sm">{{ __('Submit') }}</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
