<?php

namespace App\Helpers;

use App\Enums\MatchFormat;
use App\Models\Team;
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

    /**
     * Creates matches from a nx2 array (array<[Team, Team]>) of teams. Intended to be used on group stage (swiss) stages.
     * Considers team's set timezones to find an optimal time to play.
     *
     * @param TournamentStageRound $round
     * @param array $matchUps
     * @return void
     */
    public static function generateMatchesFromMatchUps(TournamentStageRound $round, array $matchUps)
    {
        $days = 3;
        $maxMatchesPerDay = count($matchUps) / $days + 1;

        $i = 1;
        $matchesThisDay = 0;
        $currentDay = $round->starts_at->endOfWeek()->copy();
        foreach ($matchUps as [$team1, $team2]) {
            if ($matchesThisDay > $maxMatchesPerDay) {
                $currentDay->addDays(-1);
                $matchesThisDay = 0;
            }

            $hour = self::findOptimalHourFromMatchUp($team1, $team2);
            $timestamp = $currentDay->copy()->addHours($hour);

            // TODO array insert
            $round->matches()->create([
                'label' => $i, // TODO: figure out labels
                'team1_id' => $team1->id,
                'team2_id' => $team2->id,
                'timestamp' => $timestamp
            ]);

            $matchesThisDay++;
        }
    }

    private static int $optimalHour = 19;

    private static function findOptimalHourFromMatchUp(Team $team1, Team $team2): int
    {
        $time1 = $team1->timezone_offset;
        $time2 = $team2->timezone_offset;

        $difference = (($time1 - $time2 + 12) % 24) - 12;
        $middleTimezone = (($time1 - $difference / 2 + 12) % 24) - 12;
        return ((MatchGenerator::$optimalHour - $middleTimezone) % 24) / 24;
    }
}
