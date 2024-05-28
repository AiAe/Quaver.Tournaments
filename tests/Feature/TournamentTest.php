<?php

namespace Tests\Feature;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use App\Enums\UserRoles;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TournamentTest extends TestCase
{
    use RefreshDatabase;

    private User $organizer;
    private Tournament $tournament;
    private Tournament $fullTournament;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();

        $this->fullTournament = Tournament::where('format', TournamentFormat::Team)
            ->where('status', TournamentStatus::RegistrationsOpen)
            ->first();

        $this->organizer = User::factory()->create();
        $this->organizer->addRole(UserRoles::Organizer);

        $this->tournament = Tournament::create([
            'user_id' => $this->organizer->id,
            'name' => 'qot_factory',
            'slug' => 'qot_factory',
            'format' => TournamentFormat::Solo,
            'status' => TournamentStatus::Unlisted
        ]);
    }

    public function testIndex()
    {
        $this->get(route('web.tournaments.index'))
            ->assertOk();
    }

    public function testUnlistedSearch()
    {
        $unlisted = Tournament::factory()->create(['status' => TournamentStatus::Unlisted]);

        $this->get(route('web.tournaments.index'))
            ->assertDontSee($unlisted->name);
    }

    public function testUnlistedShow()
    {
        $player = User::factory()->create();

        $this->get(route('web.tournaments.show', $this->tournament))
            ->assertForbidden();

        $this->actingAs($this->organizer)
            ->get(route('web.tournaments.show', $this->tournament))
            ->assertOk();

        $this->actingAs($player)
            ->get(route('web.tournaments.show', $this->tournament))
            ->assertForbidden();
    }

    public function testEditAndUpdate()
    {
        $this->assertTrue($this->organizer->can('update', $this->tournament));
        $this->assertFalse(User::factory()->create()->can('update', $this->tournament));

        $this->get(route('web.tournaments.edit', $this->tournament))
            ->assertForbidden();

        $data = ['status' => TournamentStatus::RegistrationsOpen->value];
        $this->put(route('web.tournaments.update', $this->tournament), $data)
            ->assertForbidden();

        $this->actingAs($this->organizer)
            ->get(route('web.tournaments.edit', $this->tournament))
            ->assertOk()
            ->assertSee('Status')
            ->assertSee('Rank')
            ->assertSee('Prize');

        $this->actingAs($this->organizer)
            ->put(route('web.tournaments.update', $this->tournament), $data)
            ->assertRedirect();

        $this->tournament->refresh();
        $this->assertEquals(TournamentStatus::RegistrationsOpen, $this->tournament->status);

        $data = ['discord' => 'https://discord.com'];
        $this->actingAs($this->organizer)
            ->put(route('web.tournaments.update', $this->tournament), $data)->assertRedirect();
        $this->tournament->refresh();
        $this->assertEquals('ababa', $this->tournament->discord);
    }

    public function testDelete()
    {
        $this->assertTrue($this->organizer->can('delete', $this->tournament));
        $this->assertFalse(User::factory()->create()->can('delete', $this->tournament));

        $this->delete(route('web.tournaments.destroy', $this->tournament))
            ->assertForbidden();

        $this->actingAs($this->organizer)
            ->delete(route('web.tournaments.destroy', $this->tournament))
            ->assertRedirect();

        $this->assertSoftDeleted($this->tournament);
    }

    public function testMappoolIndex()
    {
        $this->get(route('web.tournaments.mappools', $this->fullTournament))
            ->assertOk();
    }

    public function testSchedulesIndex()
    {
        $this->get(route('web.tournaments.schedules', $this->fullTournament))
            ->assertRedirect();
    }

    public function testTeamsIndex()
    {
        $this->get(route('web.tournaments.teams.index', $this->fullTournament))
            ->assertOk();
    }
}
