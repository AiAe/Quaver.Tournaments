@php use Carbon\Carbon; @endphp
<table class="tournament_schedules">
    <thead>
    <tr>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @for($i = 0; $i < 10; $i++)
        <x-schedules.schedule
            title="Registration"
            :date_from="Carbon::now()->format('d.m')"
            :date_to="Carbon::now()->addDays(30)->format('d.m')"/>
    @endfor
    </tbody>
</table>
