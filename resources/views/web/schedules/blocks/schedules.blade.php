<table class="tournament_schedules">
    <thead>
    <tr>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @for($i = 0; $i < 10; $i++)
        @include('web.schedules.components.schedule', ['title' => 'Registration', 'date_from' => \Carbon\Carbon::now()->format('d.m'), 'date_to' => \Carbon\Carbon::now()->addDays(30)->format('d.m')])
    @endfor
    </tbody>
</table>
