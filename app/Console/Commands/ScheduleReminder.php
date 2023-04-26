<?php

namespace App\Console\Commands;

use App\Enums\StaffRole;
use App\Enums\TournamentStageFormat;
use App\Enums\TournamentStatus;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Str;
use Woeler\DiscordPhp\Message\DiscordTextMessage;
use Woeler\DiscordPhp\Webhook\DiscordWebhook;

class ScheduleReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tournament:schedule-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scans the lobbies that come up and notifies in Discord';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Tournament::where('status', '=', TournamentStatus::Ongoing)
            ->with([
                'stages',
                'stages.rounds',
                'stages.rounds.matches',
                'stages.rounds.matches.ffaParticipants',
                'stages.rounds.matches.ffaParticipants.members',
                'stages.rounds.matches.team1',
                'stages.rounds.matches.team2',
                'stages.rounds.matches.staff',
                'stages.rounds.matches.staff.user'
            ])
            ->chunk(1000, function ($tournaments) {
                foreach ($tournaments as $tournament) {
                    $wh_player_reminders = $tournament->getMeta('discord_webhook_reminders');
                    $wh_staff_reminders = $tournament->getMeta('discord_webhook_reminders_staff');

                    // Skip tournament if they haven't setup reminders
                    if (empty($wh_player_reminders) && empty($wh_staff_reminders)) continue;

                    foreach ($tournament->stages as $stage) {
                        // Skip registration stage
                        if ($stage->stage_format == TournamentStageFormat::Registration) continue;

                        $qualifier = ($stage->stage_format == TournamentStageFormat::Qualifier);
                        $now = Carbon::now();

                        foreach ($stage->rounds as $round) {
                            // Check if the round is today
                            if ($now->between($round->starts_at, $round->ends_at)) {
                                foreach ($round->matches as $match) {
                                    // Ignore match if notified
                                    if ($match->notified) continue;

                                    $minutes = $match->timestamp->diffInMinutes($now);

                                    // Check if match starts in an hour
                                    if (!($minutes <= 59)) continue; // 59

                                    $lobby = $match->label;
                                    $timestamp = $match->timestamp;

                                    $match_staff = collect($match->staff);
                                    $match_referee = $match_staff->where('role', StaffRole::Referee)->first();
                                    $match_streamer = $match_staff->where('role', StaffRole::Streamer)->first();
                                    $match_commentator1 = $match_staff->where('role', StaffRole::Commentator)->first() ?? null;
                                    $match_commentator2 = $match_staff->where('role', StaffRole::Commentator)
                                        ->where('user_id', '!=', $match_commentator1?->user_id)->first() ?? null;

                                    // ToDo handle this properly and send msg to staff that ref is missing
                                    if (!$match_referee) continue;

                                    $referee = $match_referee->user;

                                    $ping_list = [];

                                    if ($qualifier) {
                                        // Use ffaParticipants if stage is Qualifiers
                                        foreach ($match->ffaParticipants as $team) {
                                            $team_members_discord_ids = $team->members->pluck('discord_user_id')->toArray();
                                            $ping_list = array_merge($ping_list, $team_members_discord_ids);
                                        }
                                    } else {
                                        $team1_captain = $match->team1->captain();
                                        $team2_captain = $match->team2->captain();

                                        if ($team1_captain && $team2_captain) {
                                            $ping_list[] = $team1_captain->discord_user_id;
                                            $ping_list[] = $team2_captain->discord_user_id;
                                        }
                                    }

                                    // Don't send pings if lobby is empty
                                    if (count($ping_list) == 0) continue;

                                    $streamed = false;
                                    if ($match_streamer) {
                                        $streamed = true;
                                    }

                                    $commentators_list = [];

                                    if ($streamed) {
                                        if ($match_commentator1) {
                                            $commentators_list[] = $match_commentator1->user->discord_user_id;
                                        }

                                        if ($match_commentator2) {
                                            $commentators_list[] = $match_commentator2->user->discord_user_id;
                                        }
                                    }

                                    if (!empty($wh_player_reminders)) {
                                        $this->notify($wh_player_reminders, strtr($this->players_message_basic(), [
                                            '{lobby}' => $lobby,
                                            '{discord_timestamp}' => sprintf("<t:%s:R>", $timestamp->timestamp),
                                            '{timestamp}' => $timestamp,
                                            '{referee_username}' => $referee->username,
                                            '{referee_discord}' => sprintf("<@%s>", $referee->discord_user_id),
                                            '{players}' => "<@" . implode("> <@", $ping_list) . ">",
                                            '{stream}' => $streamed ? __('Yes') : __('No')
                                        ]));
                                    }

                                    if (!empty($wh_staff_reminders)) {
                                        $this->notify($wh_staff_reminders, strtr($this->staff_message_basic(), [
                                            '{lobby}' => $lobby,
                                            '{discord_timestamp}' => sprintf("<t:%s:R>", $timestamp->timestamp),
                                            '{timestamp}' => $timestamp,
                                            '{referee_username}' => $referee->username,
                                            '{referee_discord}' => sprintf("<@%s>", $referee->discord_user_id),
                                            '{lobby_password}' => Str::random(8),
                                            '{streamer_discord}' => ($match_streamer) ? sprintf("<@%s>", $match_streamer->user->discord_user_id) : 'None',
                                            '{commentators}' => ($commentators_list) ? "<@" . implode("> <@", $commentators_list) . ">" : 'None'
                                        ]));
                                    }

                                    $match->notified = true;
                                    $match->save();
                                }
                            }
                        }
                    }
                }
            });
    }

    private function players_message_basic()
    {
        return <<<HTML
        Lobby **{lobby}** will start {discord_timestamp} - {timestamp} (UTC+0)
        Referee for this lobby is **{referee_username}** - {referee_discord}
        Streamed: {stream}

        **Referee will send invites 10 minutes early!**

        Players who are playing:
        {players}
        HTML;
    }

    private function staff_message_basic()
    {
        return <<<HTML
        Lobby **{lobby}** will start {discord_timestamp} - {timestamp} (UTC+0)
        Referee for this lobby is **{referee_username}** - {referee_discord}
        Streamer: {streamer_discord}
        Commentators: {commentators}

        **Generated lobby password: {lobby_password}**

        **Please react to this message to confirm you're available**
        **else please inform and find someone to replace you!**
        HTML;
    }

    private function notify($wh, $msg)
    {
        $discord_message = new DiscordTextMessage();
        $discord_message->setContent($msg);
        $discord_webhook = new DiscordWebhook($wh);
        $discord_webhook->send($discord_message);
    }
}
