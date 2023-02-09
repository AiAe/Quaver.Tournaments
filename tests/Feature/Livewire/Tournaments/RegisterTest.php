<?php

namespace Tests\Feature\Livewire\Tournaments;

use App\Enums\TournamentFormat;
use App\Enums\TournamentStatus;
use App\Http\Livewire\Tournament\Register;
use App\Http\Livewire\Tournament\Team\Invite;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    private Tournament $tournament;
    private User $player;

    protected function setUp(): void
    {
        parent::setUp();
        $this->player = User::factory()->create();
        $this->tournament = Tournament::factory()->create();
    }

    /** @test */
    public function player_cannot_register_when_tournament_is_unlisted()
    {
        $this->tournament->status = TournamentStatus::Unlisted;
        $this->tournament->save();

        $this->actingAs($this->player)
            ->get(route('web.tournaments.show', $this->tournament))
            ->assertDontSeeLivewire('tournament.register');
    }

    /** @test */
    public function player_can_see_register()
    {
        $this->tournament->status = TournamentStatus::RegistrationsOpen;
        $this->tournament->save();

        $this->actingAs($this->player)
            ->get(route('web.tournaments.show', $this->tournament))
            ->assertSeeLivewire('tournament.register');
    }

    /** @test */
    public function player_needs_to_login_to_register()
    {
        $this->get(route('web.tournaments.show', $this->tournament))
            ->assertDontSeeLivewire('tournament.register');
    }

    /** @test */
    public function player_register_format_solo()
    {
        $tournament = Tournament::factory()->create([
            'status' => TournamentStatus::RegistrationsOpen,
            'format' => TournamentFormat::Solo
        ]);

        $this->actingAs($this->player);

        Livewire::test(Register::class, ['tournament' => $tournament])
            ->set('name', $this->player->username)
            ->set('slug', $this->player->username)
            ->call('create')
            ->assertSuccessful();
    }

    /** @test */
    public function player_register_format_team()
    {
        $tournament = Tournament::factory()->create([
            'status' => TournamentStatus::RegistrationsOpen,
            'format' => TournamentFormat::Team
        ]);

        $this->actingAs($this->player);

        Livewire::test(Register::class, ['tournament' => $tournament])
            ->set('name', 'TestingTeam')
            ->set('slug', 'testing-team')
            ->call('create')
            ->assertHasNoErrors();
    }

    /** @test */
    public function team_invite()
    {
        $player = User::factory()->create();
        $team = Team::factory()->create();
        $team->members()->attach($player, ['is_captain' => true]);

        Tournament::where('id', $team->tournament_id)->update([
            'status' => TournamentStatus::RegistrationsOpen
        ]);

        $player2 = User::factory()->create();

        Livewire::actingAs($player)
            ->test(Invite::class, ['tournament_id' => $team->tournament_id])
            ->set('tournament_id', $team->tournament_id)
            ->set('team_id', $team->id)
            ->set('username', $player2->username)
            ->call('create')->assertHasNoErrors();

        $this->assertTrue($team->invites()->where('user_id', $player2->id)->exists());
    }

    /** @test */
    public function register_unique_slug()
    {
        $tournament = Tournament::factory()->create([
            'status' => TournamentStatus::RegistrationsOpen,
            'format' => TournamentFormat::Team
        ]);

        $player2 = User::factory()->create();

        Livewire::actingAs($this->player)
            ->test(Register::class, ['tournament' => $tournament])
            ->set('name', 'TestingTeam')
            ->set('slug', 'testing-team')
            ->call('create')
            ->assertHasNoErrors();

        Livewire::actingAs($player2)
            ->test(Register::class, ['tournament' => $tournament])
            ->set('name', 'TestingTeam')
            ->set('slug', 'testing-team')
            ->call('create')
            ->assertHasErrors();
    }
}
