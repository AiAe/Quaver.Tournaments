<?php

namespace Tests\Feature;

use App\Enums\StaffRole;
use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use App\Enums\UserRoles;
use App\Models\Tournament;
use App\Models\TournamentStaff;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TournamentStaffTest extends TestCase
{
    use RefreshDatabase;

    private User $organizer;
    private User $staff;
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

        $this->staff = User::factory()->create();
        $this->tournament
            ->staff()
            ->create(['user_id' => $this->staff->id, 'staff_role' => StaffRole::Referee]);
    }

    public function testIndex()
    {
        $this->get(route('web.tournaments.staff.index', $this->tournament))
            ->assertForbidden();

        $this->actingAs($this->organizer)
            ->get(route('web.tournaments.staff.index', $this->tournament))
            ->assertOk();
    }

    public function testCreate()
    {
        $route = route('web.tournaments.staff.create', $this->tournament);
        $this->get($route)->assertForbidden();
        $this->actingAs($this->organizer)->get($route)->assertOk();
    }

    public function testStore()
    {
        $user = User::factory()->create();
        $data = ['username' => $user->username, 'role' => StaffRole::Referee->value];

        $route = route('web.tournaments.staff.store', $this->tournament);
        $this->post($route, $data)->assertForbidden();
        $this->actingAs($this->organizer)->post($route, $data)->assertRedirect();

        $staff = TournamentStaff::where('tournament_id', $this->tournament->id)
            ->where('user_id', $user->id)
            ->first();

        $this->assertEquals(StaffRole::Referee, $staff->staff_role);

        // duplicate
        $this->actingAs($this->organizer)->post($route, $data)->assertSessionHasErrorsIn('role');
    }

    public function testDestroy()
    {
        $route = route('web.tournaments.staff.destroy', ['tournament' => $this->tournament, 'staff' => $this->tournament->staff->first()]);
        $this->delete($route)->assertForbidden();
        $this->actingAs($this->organizer)->delete($route)->assertRedirect();

        $this->assertDatabaseMissing('tournament_staff', ['user_id' => $this->staff->id]);
    }
}
