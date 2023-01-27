<?php

namespace Tests\Feature;

use App\Enums\TournamentStatus;
use App\Enums\UserRoles;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TournamentTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
        $this->admin->addRole(UserRoles::Admin);
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

        $this->actingAs($this->admin)
            ->get(route('web.tournaments.index'))
            ->assertSee($unlisted->name);
    }

    public function testUnlistedShow()
    {
        $unlisted = Tournament::factory()
            ->create(['status' => TournamentStatus::Unlisted]);

        $this->get(route('web.tournaments.show', $unlisted))
            ->assertForbidden();

        $this->actingAs($this->admin)
            ->get(route('web.tournaments.show', $unlisted))
            ->assertOk();

        $this->actingAs($unlisted->user)
            ->get(route('web.tournaments.show', $unlisted))
            ->assertOk();
    }
}
