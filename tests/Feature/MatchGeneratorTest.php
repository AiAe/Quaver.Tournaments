<?php

namespace Tests\Feature;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStageFormat;
use App\Enums\TournamentStatus;
use App\Helpers\MatchGenerator;
use App\Models\Tournament;
use App\Models\TournamentStageRound;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MatchGeneratorTest extends TestCase
{
    use RefreshDatabase;

    private TournamentStageRound $qualifiers;
    private TournamentStageRound $swiss;

    public function testQualifierGenerator()
    {
        $timestamps = [];
        for ($hour = 0; $hour < 13 * 24 + 1; $hour++) {
            $timestamps[] = Carbon::now()->startOfWeek()->addHours($hour);
        }

        MatchGenerator::generateQualifierLobbies($this->qualifiers, $timestamps);

        $matches = $this->qualifiers->matches()
            ->orderBy('timestamp')
            ->limit(count($timestamps))
            ->pluck('label');

        $this->assertEquals(count($timestamps), $matches->count());
        $this->assertEquals('1-MON-00:00', $matches->first());
        $this->assertEquals('2-SAT-23:00', $matches->last());
    }

    public function testOptimalTimezone()
    {
        $this->assertEquals(0, MatchGenerator::getMiddleTimezone(0, 0));
        $this->assertEquals(2, MatchGenerator::getMiddleTimezone(2, 2));
        $this->assertEquals(11, MatchGenerator::getMiddleTimezone(11, 11));
        $this->assertEquals(1, MatchGenerator::getMiddleTimezone(0, 2));
        $this->assertEquals(6, MatchGenerator::getMiddleTimezone(0, 12));
        $this->assertEquals(0, MatchGenerator::getMiddleTimezone(-2, 2));
        $this->assertEquals(0, MatchGenerator::getMiddleTimezone(-5, 5));
        $this->assertEquals(-12, MatchGenerator::getMiddleTimezone(-8, 8));
        $this->assertEquals(-11, MatchGenerator::getMiddleTimezone(-8, 10));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $tournament = Tournament::factory()->create([
            'format' => TournamentFormat::Team,
            'status' => TournamentStatus::Ongoing
        ]);

        $this->qualifiers = $tournament->stages()
            ->create([
                'name' => 'Qualifiers',
                'stage_format' => TournamentStageFormat::Qualifier,
                'index' => 0
            ])
            ->rounds()
            ->create([
                'name' => 'Qualifier 1',
                'index' => 0,
                'starts_at' => Carbon::now()->addDays(-5),
                'ends_at' => Carbon::now()->addDays(2),
            ]);

        $this->swiss = $tournament->stages()
            ->create([
                'name' => 'Swiss',
                'stage_format' => TournamentStageFormat::Swiss,
                'index' => 1
            ])
            ->rounds()
            ->create([
                'name' => 'Swiss 1',
                'index' => 0,
                'starts_at' => Carbon::now()->addWeek()->addDays(-5),
                'ends_at' => Carbon::now()->addWeek()->addDays(2),
            ]);
    }
}
