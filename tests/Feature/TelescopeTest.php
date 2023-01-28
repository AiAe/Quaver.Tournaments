<?php

namespace Tests\Feature;

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// Telescope is disabled during testing
class TelescopeTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    public function testSeeLinkInDashboard()
    {
        $this->get('/')
            ->assertDontSee('/telescope');

        $this->actingAs($this->admin)
            ->get('/')
            ->assertSee('/telescope');
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
        $this->admin->addRole(UserRoles::Admin);
    }
}
