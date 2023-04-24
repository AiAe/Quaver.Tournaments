<?php

namespace App\Helpers;

use App\Enums\MatchFormat;
use App\Models\Team;
use App\Models\TournamentStageRound;

class MatchGenerator
{
    /**
     * Creates Qualifier lobbies based on an array of timestamps.
     *
     * @param  TournamentStageRound  $round  Round to insert the lobbies into
     * @param  array  $timestamps  Array of Carbon timestamps to generate the lobbies at
     */
    public static function generateQualifierLobbies(TournamentStageRound $round, array $timestamps)
    {
        $timestamps = collect($timestamps)->sort();
        $first = $timestamps->first()->copy();
        $last = $timestamps->last()->copy();

        $isMultiWeek = $last->startOfWeek()->diff($first->startOfWeek())->d / 7 > 0;

        foreach ($timestamps as $timestamp) {
            $week = ($timestamp->copy()->startOfWeek()->diff($first->startOfWeek())->d) / 7 + 1;
            $label = strtoupper($timestamp->isoFormat('ddd-HH:mm'));

            if ($isMultiWeek) {
                $label = "$week-$label";
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
     * @param  TournamentStageRound  $round
     * @param  array  $matchUps
     * @return void
     */
    public static function generateMatchesFromMatchUps(
        TournamentStageRound $round,
        array $matchUps,
        $label_start = "lobby"
    ) {
        $days = 3;
        $maxMatchesPerDay = count($matchUps) / $days + 1;

        $i = 1;
        $matchesThisDay = 0;
        $currentDay = $round->starts_at->endOfWeek()->startOfDay()->copy();
        foreach ($matchUps as [$team1, $team2]) {
            if ($matchesThisDay > $maxMatchesPerDay) {
                $currentDay->addDays(-1);
                $matchesThisDay = 0;
            }

            $hour = self::findOptimalHourFromMatchUp($team1, $team2);
            $timestamp = $currentDay->copy()->addHours($hour);

            $round->matches()->create([
                'label' => sprintf("%s-%s", $label_start, $i),
                'team1_id' => $team1,
                'team2_id' => $team2,
                'timestamp' => $timestamp
            ]);

            $i++;

            $matchesThisDay++;
        }
    }

    public static int $optimalHour = 17;

    public static function findOptimalHourFromMatchUp($team1, $team2): int
    {
        $team1 = Team::where('id', $team1)->first();
        $team1_captain = $team1->captain();
        $team1Tz = $team1->timezone_offset ?? $team1_captain->timezone_offset ?? 0;

        $team2 = Team::where('id', $team2)->first();
        $team2_captain = $team2->captain();
        $team2Tz = $team2->timezone_offset ?? $team2_captain->timezone_offset ?? 0;

        $middleTimezone = self::getMiddleTimezone($team1Tz, $team2Tz);
        return (MatchGenerator::$optimalHour - $middleTimezone) % 24;
    }

    public static function getMiddleTimezone(int $timezone1, int $timezone2): int
    {
        $difference = (($timezone1 - $timezone2 + 12) % 24) - 12;
        if ($difference > 12 || $difference < -12) {
            $difference = (24 - abs($difference)) % 24;
        }

        return (($timezone1 - $difference / 2 + 12) % 24) - 12;
    }
}
