<?php

namespace Tests\Feature\Livewire\Tournaments;

use App\Enums\TournamentFormat;
use App\Enums\UserRoles;
use App\Http\Livewire\Tournaments\Create;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    private User $organiser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->organiser = User::factory()->create();
        $this->organiser->addRole(UserRoles::Organizer);
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
        $this->actingAs($this->organiser);

        Livewire::test(Create::class)
            ->set('name', 'qot_factory')
            ->set('slug', 'QOT7KFactory2023')
            ->set('format', TournamentFormat::Solo->value)
            ->call('create');

        $this->assertTrue(Tournament::whereSlug('QOT7KFactory2023')->exists());
    }

    /** @test */
    public function name_is_required()
    {
        Livewire::actingAs($this->organiser)
            ->test(Create::class)
            ->set('name', '')
            ->set('slug', 'QOTFactory2023')
            ->call('create')
            ->assertHasErrors([
                'name' => 'required'
            ]);
    }

    /** @test */
    public function special_characters_not_allowed()
    {
        Livewire::actingAs($this->organiser)
            ->test(Create::class)
            ->set('name', 'QOT!2023')
            ->set('slug', 'QOTFactory_2023')
            ->call('create')
            ->assertHasErrors([
                'name' => 'regex'
            ]);

        Livewire::actingAs($this->organiser)
            ->test(Create::class)
            ->set('name', 'QOT 2023')
            ->set('slug', 'QOTFactory2023!')
            ->call('create')
            ->assertHasErrors([
                'slug' => 'regex'
            ]);
    }

    /** @test */
    public function slug_is_required()
    {
        Livewire::actingAs($this->organiser)
            ->test(Create::class)
            ->set('name', 'qotfactory')
            ->set('slug', '')
            ->call('create')
            ->assertHasErrors([
                'slug' => 'required'
            ]);
    }

    /** @test */
    public function is_redirected_to_tournament_page_after_creation()
    {
        $this->actingAs($this->organiser);

        $response = Livewire::actingAs($this->organiser)
            ->test(Create::class)
            ->set('name', 'qotfactory')
            ->set('slug', 'QOTFactory2023')
            ->set('format', TournamentFormat::Solo->value)
            ->call('create');

        $redirect = $response->payload['effects']['redirect'];
        $id = basename($redirect);

        $this->assertEquals(route('web.tournaments.show', $id), $redirect);
    }

    /** @test */
    public function unique_tournament_slug()
    {
        $this->actingAs($this->organiser);

        Livewire::actingAs($this->organiser)
            ->test(Create::class)
            ->set('name', 'qotfactory2')
            ->set('slug', 'QOTFactory2023')
            ->set('format', TournamentFormat::Solo->value)
            ->call('create');

        Livewire::actingAs($this->organiser)
            ->test(Create::class)
            ->set('name', 'qotfactory2')
            ->set('slug', 'QOTFactory2023')
            ->set('format', TournamentFormat::Team->value)
            ->call('create')
            ->assertHasErrors([
                'slug' => 'unique'
            ]);
    }

}
