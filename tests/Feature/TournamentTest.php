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

    private User $organiser;
    private Tournament $tournament;

    protected function setUp(): void
    {
        parent::setUp();
        $this->organiser = User::factory()->create();
        $this->organiser->addRole(UserRoles::Organizer);

        $this->tournament = Tournament::create([
            'user_id' => $this->organiser->id,
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

        $this->actingAs($this->organiser)
            ->get(route('web.tournaments.show', $this->tournament))
            ->assertOk();

        $this->actingAs($player)
            ->get(route('web.tournaments.show', $this->tournament))
            ->assertForbidden();
    }
}
