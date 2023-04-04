<?php

namespace App\Helpers;

use App\Enums\MatchFormat;
use App\Models\TournamentStageRound;
use Carbon\Carbon;

class MatchGenerator
{
    /**
     * Creates Qualifier lobbies based on an array of timestamps.
     *
     * @param TournamentStageRound $round Round to insert the lobbies into
     * @param array $timestamps Array of Carbon timestamps to generate the lobbies at
     */
    public static function generateQualifierLobbies(TournamentStageRound $round, array $timestamps)
    {
        $timestamps = collect($timestamps);

        $first = $timestamps->min();
        $last = $timestamps->max();
        $multiWeek = $first->addDays(7) > $last;

        foreach ($timestamps as $timestamp) {
            $timestamp = Carbon::now();
            $week = $timestamp->week - $first->week + 1;
            $weekday = $timestamp->englishDayOfWeek;
            $time = $timestamp->format('H:i');

            if ($multiWeek) {
                $label = "$week-$weekday-$time";
            } else {
                $label = "$weekday-$time";
            }

            $round->matches()->create([
                'label' => $label,
                'timestamp' => $timestamp,
                'match_format' => MatchFormat::FreeForAll,
            ]);
        }
    }
}
