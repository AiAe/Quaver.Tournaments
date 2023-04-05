<?php

namespace App\Http\Controllers\Web\Tournament;

use App\Enums\TournamentFormat;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamRank;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Woeler\DiscordPhp\Message\DiscordEmbedMessage;
use Woeler\DiscordPhp\Webhook\DiscordWebhook;

class TournamentTeamsController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle:day')->only('destroy');
    }

    public function index(Tournament $tournament)
    {
        $title = __('Players');

        if ($tournament->format == TournamentFormat::Team) {
            $title = __('Teams');
        }

        $teamRanks = TeamRank::where('tournament_id', $tournament->id)
            ->with('team')
            ->orderBy($tournament->mode->rankColumnName())
            ->paginate(50);

        return view('web.tournaments.teams.index', compact('tournament', 'title', 'teamRanks'));
    }

    public function show(Tournament $tournament, Team $team)
    {
        $members = $team->members()->orderBy($tournament->mode->rankColumnName())->get();
        return view('web.tournaments.teams.show', compact('tournament', 'team', 'members'));
    }

    public function edit(Team $team)
    {
    }

    public function update(Request $request, Team $team)
    {
    }

    public function destroy(Tournament $tournament, Team $team)
    {
        $this->authorize('delete', $team);

        createToast('success', '', __('Successfully withdrawn from the tournament!'));

        if ($wh = $tournament->getMeta('discord_webhook_registrations')) {
            if ($wh !== "") {
                dispatch(function () use ($team, $wh) {
                    $discord_embed_message = new DiscordEmbedMessage();

                    $discord_embed_message->setTitle('Withdraw from the tournament');
                    $discord_embed_message->setAuthorName($team->name);
                    $discord_embed_message->setColor(16711680);
                    $discord_embed_message->setTimestamp(Carbon::now());

                    $discord_webhook = new DiscordWebhook($wh);
                    $discord_webhook->send($discord_embed_message);
                });
            }
        }

        $team->delete();

        return redirect(route('web.tournaments.show', $tournament));
    }
}
