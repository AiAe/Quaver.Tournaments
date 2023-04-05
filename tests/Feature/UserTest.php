<?php

namespace Tests\Feature;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use App\Enums\UserRoles;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();

        $this->user = User::factory()->create();
    }

    public function testIfUserCanViewSettings()
    {
        $this->assertTrue($this->user->can('update', $this->user));

        $this->get(route('web.users.edit'))
            ->assertForbidden();

        $this->actingAs($this->user)
            ->get(route('web.users.edit'))
            ->assertOk();
    }

    public function testIfTimezoneIsRequired()
    {
        $this->actingAs($this->user)->put(route('web.users.update'), ['timezone_offset' => ''])
            ->assertSessionHasErrors(['timezone_offset'])
            ->assertStatus(302);
    }

    public function testIfTimezoneIsInvalid()
    {
        $this->actingAs($this->user)->put(route('web.users.update'), ['timezone_offset' => '-20'])
            ->assertSessionHasErrors('timezone_offset')
            ->assertStatus(302);
    }
}
