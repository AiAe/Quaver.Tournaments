<?php

namespace Tests\Feature;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use App\Enums\UserRoles;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TournamentStageTest extends TestCase
{
    use RefreshDatabase;

    private User $organizer;
    private Tournament $tournament;

    protected function setUp(): void
    {
        parent::setUp();
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

    public function testBasic()
    {
        $this->get(route('web.tournaments.stages.index', $this->tournament))
            ->assertForbidden();

        $this->actingAs($this->organizer)->get(route('web.tournaments.stages.index', $this->tournament))
            ->assertOk();
    }
}
