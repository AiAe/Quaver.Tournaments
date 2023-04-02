<?php

namespace Tests\Feature;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use App\Enums\UserRoles;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TournamentRulesTest extends TestCase
{
    use RefreshDatabase;

    private Tournament $tournament;
    private User $organizer;

    public function testIndex()
    {
        $this->get(route('web.tournaments.rules.show', $this->tournament))
            ->assertOk();
    }

    public function testUpdate()
    {
        $route = route('web.tournaments.rules.update', $this->tournament);

        $rules = 'ababa';

        $this->put($route, ['rules' => $rules])->assertForbidden();
        $this->actingAs($this->organizer)->put($route, ['rules' => $rules])->assertRedirect();
        $this->tournament->refresh();
        $this->assertEquals($rules, $this->tournament->rules);

        $rules = str_repeat('too long', 10_000);

        $this->actingAs($this->organizer)->put($route, ['rules' => $rules])->assertSessionHasErrors(['rules']);
    }

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
}
