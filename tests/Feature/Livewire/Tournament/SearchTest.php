<?php

namespace Livewire\Tournament;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use App\Enums\UserRoles;
use App\Http\Livewire\Tournament\Search;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire;
use Tests\TestCase;

class SearchTest extends TestCase
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
        Livewire::test(Search::class)->assertOk();
    }

    public function testIndexContainsComponent()
    {
        $this->get(route('web.tournaments.index'))
            ->assertSeeLivewire(Search::class);
    }

    public function testCanPartiallySearchTitle()
    {
        $tour = Tournament::firstWhere('status', TournamentStatus::RegistrationsOpen);
        Livewire::test(Search::class)
            ->set('search', substr($tour->name, 0, 4))
            ->assertSee($tour->name);
    }

    public function testCannotSearchUnlisted()
    {
        $tour = Tournament::firstWhere('status', TournamentStatus::Unlisted);

        Livewire::test(Search::class)
            ->set('status', TournamentStatus::Unlisted)
            ->assertDontSee($tour->name);

        Livewire::actingAs($this->admin)
            ->test(Search::class)
            ->set('status', TournamentStatus::Unlisted)
            ->assertSee($tour->name);
    }

    public function testQueryParams()
    {
        Livewire::withQueryParams(['search' => 'ababa'])
            ->test(Search::class)
            ->assertSet('search', 'ababa');
    }
}
