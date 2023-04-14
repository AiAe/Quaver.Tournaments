<?php

namespace Tests\Feature;

use App\Enums\MatchFormat;
use App\Enums\TournamentFormat;
use App\Enums\TournamentStageFormat;
use App\Enums\TournamentStatus;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\TournamentMatch;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MatchPolicyTest extends TestCase
{
    use RefreshDatabase;

    private Tournament $tournament;
    private Team $team;
    private User $captain;
    private TournamentMatch $match;

    public function testAssignTeamToQualifier()
    {
        $this->app->instance('loggedUserTeam', $this->team);
        $this->app->instance('loggedUserTeamCaptain', $this->team->captain()->is($this->captain));
        $this->assertTrue($this->captain->can('assignTeamToQualifierLobby', $this->match));
    }

    public function testAssignTeamToQualifierNotQualifier()
    {
        $stage = $this->match->round->stage;
        $stage->stage_format = TournamentStageFormat::Swiss;
        $stage->save();

        $this->assertFalse($this->captain->can('assignTeamToQualifierLobby', $this->match));
    }

    public function testAssignTeamToQualifierInPast()
    {
        $this->match->timestamp = Carbon::now()->addDays(-1);
        $this->match->save();

        $this->assertFalse($this->captain->can('assignTeamToQualifierLobby', $this->match));
    }

    public function testAssignTeamToQualifierNotCaptain()
    {
        $this->app->instance('loggedUserTeam', $this->team);

        $notCaptain = $this->team->members()->wherePivot('is_captain', false)->first();

        $this->app->instance('loggedUserTeamCaptain', $this->team->captain()->is($notCaptain));

        $this->assertFalse($notCaptain->can('assignTeamToQualifierLobby', $this->match));
    }

    public function testWithdrawTeamFromQualifier()
    {
        $this->app->instance('loggedUserTeam', $this->team);
        $this->app->instance('loggedUserTeamCaptain', $this->team->captain()->is($this->captain));

        $this->match->ffaParticipants()->attach($this->team);

        $this->assertTrue($this->captain->can('withdrawTeamFromQualifierLobby', $this->match));
    }

    public function testWithdrawTeamFromQualifierNotQualifier()
    {
        $this->match->ffaParticipants()->attach($this->team);

        $stage = $this->match->round->stage;
        $stage->stage_format = TournamentStageFormat::Swiss;
        $stage->save();

        $this->assertFalse($this->captain->can('withdrawTeamFromQualifierLobby', $this->match));
    }

    public function testWithdrawTeamFromQualifierTooLate()
    {
        $this->app->instance('loggedUserTeam', $this->team);
        $this->app->instance('loggedUserTeamCaptain', $this->team->captain()->is($this->captain));

        $this->match->ffaParticipants()->attach($this->team);

        $this->match->timestamp = Carbon::now()->addDays(-1);
        $this->match->save();

        $this->assertFalse($this->captain->can('withdrawTeamFromQualifierLobby', $this->match));

        $this->match->timestamp = Carbon::now()->addMinutes(30);
        $this->match->save();

        $this->assertFalse($this->captain->can('withdrawTeamFromQualifierLobby', $this->match));
    }

    public function testWithdrawTeamFromQualifierNotCaptain()
    {
        $this->match->ffaParticipants()->attach($this->team);

        $this->app->instance('loggedUserTeam', $this->team);
        $this->app->instance('loggedUserTeamCaptain', $this->team->captain()->is($this->captain));

        $notCaptain = $this->team->members()->wherePivot('is_captain', false)->first();
        $this->assertFalse($notCaptain->can('assignTeamToQualifierLobby', $this->match));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->tournament = Tournament::factory()->create([
            'format' => TournamentFormat::Team,
            'status' => TournamentStatus::Ongoing
        ]);

        $this->team = Team::factory()
            ->recycle($this->tournament)
            ->hasAttached(
                User::factory(4),
                new Sequence(fn($sequence) => ['is_captain' => $sequence->index == 0]),
                'members'
            )->create();

        $this->captain = $this->team->captain();

        $qualifier = $this->tournament->stages()
            ->create([
                'name' => 'Qualifiers',
                'stage_format' => TournamentStageFormat::Qualifier,
                'index' => 0
            ])
            ->rounds()
            ->create([
                'name' => 'Qualifier',
                'index' => 0,
                'starts_at' => Carbon::now()->addDays(-5),
                'ends_at' => Carbon::now()->addDays(2),
            ]);

        $this->match = TournamentMatch::factory()
            ->recycle($qualifier)
            ->create(new Sequence(fn($seq) => [
                'label' => 'q',
                'timestamp' => Carbon::now()->addDays(1),
                'match_format' => MatchFormat::FreeForAll,
                'team1_id' => null,
                'team2_id' => null
            ]));
    }
}
