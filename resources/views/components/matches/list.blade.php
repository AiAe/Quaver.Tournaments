<div>
    <div class="rounds">
        @forelse($matches as $key => $timestamps)
            <div class="round-name d-flex align-items-center">
                <span></span> {{ \Carbon\Carbon::parse($key)->format('F j l') }}
            </div>
            @foreach($timestamps as $match)
                <div class="round {{ $class??"" }}">
                    <div class="row">
                        <div class="col-lg-3">
                            <table>
                                <tr>
                                    <th style="width: 50%;"></th>
                                    <th style="width: 50%;"></th>
                                </tr>
                                <tr>
                                    <td>{{ $match->timestamp->format('H:i \U\T\C') }}</td>
                                    <td>{{ __('Referee') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table>
                                <tr>
                                    <th style="width: 33%;"></th>
                                    <th style="width: 33%;"></th>
                                    <th style="width: 33%;"></th>
                                </tr>
                                <tr>
                                    <td>{{ Str::limit($match->team1->name, 15) }}</td>
                                    <td style="padding: 0 6px;">{{ __('vs') }}</td>
                                    <td>{{ Str::limit($match->team2->name, 15) }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-3">
                            <table>
                                <tr>
                                    <th style="width: 25%"></th>
                                    <th style="width: 25%"></th>
                                </tr>
                                <tr>
                                    <td>
{{--                                        <a href="#" class="btn btn-warning btn-sm pt-0 pb-0">{{ __('Edit') }}</a>--}}
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm pt-0 pb-0">{{ __('Details') }}</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @empty
            {{ __('There are currently no matches') }}
        @endforelse
    </div>
</div>
