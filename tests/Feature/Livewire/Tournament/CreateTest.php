<?php

namespace Livewire\Tournament;

use App\Enums\TournamentFormat;
use App\Enums\UserRoles;
use App\Http\Livewire\Tournament\Create;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
        $this->admin->addRole(UserRoles::Admin);
    }

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Create::class);

        $component->assertStatus(200);
    }

    /** @test */
    public function can_create_post()
    {
        $this->actingAs($this->admin);

        Livewire::test(Create::class)
            ->set('name', 'qot_factory')
            ->set('slug', 'QOTFactory2023')
            ->set('format', TournamentFormat::Solo->value)
            ->call('create');

        $this->assertTrue(Tournament::whereSlug('QOTFactory2023')->exists());
    }

    /** @test */
    public function name_is_required()
    {
        Livewire::actingAs($this->admin)
            ->test(Create::class)
            ->set('name', '')
            ->call('create')
            ->assertHasErrors([
                'name' => 'required'
            ]);
    }

    /** @test */
    public function slug_is_required()
    {
        Livewire::actingAs($this->admin)
            ->test(Create::class)
            ->set('name', 'qot_factory')
            ->set('slug', '')
            ->call('create')
            ->assertHasErrors([
                'slug' => 'required'
            ]);
    }

    /** @test */
    public function is_redirected_to_tournament_page_after_creation()
    {
        $this->actingAs($this->admin);

        $response = Livewire::actingAs($this->admin)
            ->test(Create::class)
            ->set('name', 'qot_factory')
            ->set('format', TournamentFormat::Solo->value)
            ->call('create');

        $redirect = $response->payload['effects']['redirect'];
        $id = basename($redirect);

        $this->assertEquals(route('web.tournaments.show', $id), $redirect);
    }
}
