<?php

namespace Tests\Feature\Livewire;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use App\Enums\UserRoles;
use App\Http\Livewire\TournamentSearch;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire;
use Tests\TestCase;

class TournamentSearchTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
        $this->admin->addRole(UserRoles::Admin);

        $count = sizeof(TournamentStatus::cases());
        Tournament::factory($count)
            ->create(new Sequence(fn($seq) => [
                'status' => TournamentStatus::values()[$seq->index],
                'format' => fake()->randomElement(TournamentFormat::values())
            ]));
    }

    public function testCanRender()
    {
        Livewire::test(TournamentSearch::class)->assertOk();
    }

    public function testIndexContainsComponent()
    {
        $this->get(route('web.tournaments.index'))
            ->assertSeeLivewire(TournamentSearch::class);
    }

    public function testCanPartiallySearchTitle()
    {
        $tour = Tournament::firstWhere('status', TournamentStatus::RegistrationsOpen);
        Livewire::test(TournamentSearch::class)
            ->set('search', substr($tour->name, 0, 4))
            ->assertSee($tour->name);
    }

    public function testCannotSearchUnlisted()
    {
        $tour = Tournament::firstWhere('status', TournamentStatus::Unlisted);

        Livewire::test(TournamentSearch::class)
            ->set('status', TournamentStatus::Unlisted)
            ->assertDontSee($tour->name);

        Livewire::actingAs($this->admin)
            ->test(TournamentSearch::class)
            ->set('status', TournamentStatus::Unlisted)
            ->assertSee($tour->name);
    }

    public function testQueryParams()
    {
        Livewire::withQueryParams(['search' => 'ababa'])
            ->test(TournamentSearch::class)
            ->assertSet('search', 'ababa');
    }
}
