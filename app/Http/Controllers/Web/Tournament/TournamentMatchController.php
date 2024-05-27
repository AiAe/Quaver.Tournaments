<?php

namespace App\Http\Controllers\Web\Tournament;

use App\Enums\StaffRole;
use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\TournamentMatch;
use App\Models\TournamentMatchStaff;
use App\Models\TournamentStageRound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Woeler\DiscordPhp\Message\DiscordTextMessage;
use Woeler\DiscordPhp\Webhook\DiscordWebhook;

class TournamentMatchController extends Controller
{
    public function edit(Tournament $tournament, TournamentStageRound $round, TournamentMatch $match)
    {
        $this->authorize('editStaff', $match);

        $title = __('Match') . ' - ' . $match->label;

        return view('web.tournaments.matches.edit', compact('title', 'match'));
    }

    public function update(Request $request, Tournament $tournament, TournamentStageRound $round, TournamentMatch $match)
    {
        $this->authorize('editStaff', $match);

        $validator = Validator::make($request->all(), [
            'referee_id' => ['nullable'],
            'streamer_id' => ['nullable'],
            'commentators' => ['nullable', 'array'],
            'referee_take' => ['nullable'],
            'referee_resign' => ['nullable'],
            'streamer_take' => ['nullable'],
            'streamer_resign' => ['nullable'],
            'commentator_take' => ['nullable'],
            'commentator_resign' => ['nullable'],
            'form_button_action' => ['nullable'],
            'mp_link' => ['nullable'],
            'timestamp' => ['nullable', 'date']
        ]);

        $validator->validate();
        $validated = $validator->validated();

        $loggedUserRoles = app('loggedUserCan');
        $loggedUser = app('loggedUser');

        if (!empty($validated['mp_link'])) {
            $mp_id = (int)basename($validated['mp_link']);

            $mp_links = $match->quaver_mp_ids ?? [];

            if (!in_array($mp_id, $mp_links)) {
                $mp_links[] = $mp_id;

                $match->quaver_mp_ids = $mp_links;
                $match->save();
            }

            return back();
        }

        // Handle commentator manual assign/resign
        if(!empty($validated['commentator_take']) && $loggedUserRoles['commentator']) {
            $commentator_spot = TournamentMatchStaff::query()
                ->where('tournament_match_id', $match->id)
                ->where('role', '=', StaffRole::Commentator)
                ->where('user_id', '=', $loggedUser->id)
                ->first();

            if($commentator_spot != null) {
                $this->spot_taken();
                return back();
            }

            $commentator1_spot = TournamentMatchStaff::query()
                ->where('tournament_match_id', $match->id)
                ->where('role', '=', StaffRole::Commentator)
                ->first();

            $commentator2_spot = TournamentMatchStaff::query()
                ->where('tournament_match_id', $match->id)
                ->where('role', '=', StaffRole::Commentator);

            if ($commentator1_spot) {
                $commentator2_spot->where('user_id', '!=', $commentator1_spot->user_id);
            }

            $commentator2_spot = $commentator2_spot->first();

            if($commentator1_spot == null) {
                $this->assign_user($match->id, $loggedUser->id, StaffRole::Commentator);
                $this->assigned_success();
            } elseif($commentator2_spot == null) {
                $this->assign_user($match->id, $loggedUser->id, StaffRole::Commentator);
                $this->assigned_success();
            } else {
                // all spots are taken
                $this->spot_taken();
            }
        }

        if(!empty($validated['commentator_resign']) && $loggedUserRoles['commentator']) {
            $commentator_spot = TournamentMatchStaff::query()
                ->where('tournament_match_id', $match->id)
                ->where('role', '=', StaffRole::Commentator)
                ->where('user_id', '=', $loggedUser->id)
                ->first();

            if($commentator_spot) {
                $commentator_spot->delete();
                $this->discharge_success();
            }
        }

        if (!empty($validated['timestamp']) && ($loggedUserRoles['organizer'] || $loggedUserRoles['head_referee'])) {
            $match->timestamp = $validated['timestamp'];
            $match->notified = 0;
            $match->save();
            $match->refresh();

            $wh_staff_reminders = $tournament->getMeta('discord_webhook_reminders_staff');

            if ($wh_staff_reminders) {
                // Check if match has staff
                $match_staff = collect($match->staff);
                $match_referee = $match_staff->where('role', StaffRole::Referee)->first();
                $match_streamer = $match_staff->where('role', StaffRole::Streamer)->first();
                $match_commentator1 = $match_staff->where('role', StaffRole::Commentator)->first() ?? null;
                $match_commentator2 = $match_staff->where('role', StaffRole::Commentator)
                    ->where('user_id', '!=', $match_commentator1?->user_id)->first() ?? null;

                $ping_list = [];

                if ($match_referee) $ping_list[] = $match_referee->user->discord_user_id;
                if ($match_streamer) $ping_list[] = $match_streamer->user->discord_user_id;
                if ($match_commentator1) $ping_list[] = $match_commentator1->user->discord_user_id;
                if ($match_commentator2) $ping_list[] = $match_commentator2->user->discord_user_id;

                if ($ping_list) {
                    $msg = <<<HTML
                    Lobby **{lobby}** has moved to {new_timestamp} (UTC+0) ({discord_new_timestamp})
                    If anyone cannot make please resign from your spot!
                    {pings}
                    HTML;

                    $discord_message = new DiscordTextMessage();
                    $discord_message->setContent(strtr($msg, [
                        '{lobby}' => $match->label,
                        '{new_timestamp}' => $match->timestamp,
                        '{discord_new_timestamp}' => sprintf("<t:%s:R>", $match->timestamp->timestamp),
                        '{pings}' => "<@" . implode("> <@", $ping_list) . ">"
                    ]));
                    $discord_webhook = new DiscordWebhook($wh_staff_reminders);
                    $discord_webhook->send($discord_message);
                }
            }
            return back();
        }

        if (($loggedUserRoles['organizer'] || $loggedUserRoles['head_referee']) && !isset($validated['form_button_action'])) {
            $referee_spot = $this->match_spot($match->id, StaffRole::Referee);

            if (isset($validated['referee_id'])) {
                $validated['referee_id'] = (int)$validated['referee_id'];

                if ($referee_spot && $referee_spot->user_id !== $validated['referee_id']) {
                    $referee_spot->delete();
                    $referee_spot = null;
                }

                if (!$referee_spot) {
                    $this->assign_user($match->id, $validated['referee_id'], StaffRole::Referee);
                }
            } else {
                if ($referee_spot) {
                    $referee_spot->delete();
                }
            }
        } else {
            // Handle normal referee
            if ($loggedUserRoles['referee']) {
                $referee_take = $validated['referee_take'] ?? null;
                $referee_resign = $validated['referee_resign'] ?? null;

                if ($referee_take || $referee_resign) {
                    $referee_spot = $this->match_spot($match->id, StaffRole::Referee);

                    if ($referee_take && !$referee_spot) {
                        $this->assign_user($match->id, $loggedUser->id, StaffRole::Referee);
                        $this->assigned_success();
                    } else {
                        $this->spot_taken();
                    }

                    if ($referee_resign && $referee_spot && $referee_spot->user_id == $loggedUser->id) {
                        $referee_spot->delete();
                        $this->discharge_success();
                    }
                }
            }
        }

        if (($loggedUserRoles['organizer'] || $loggedUserRoles['head_streamer']) && !isset($validated['form_button_action'])) {
            $streamer_spot = $this->match_spot($match->id, StaffRole::Streamer);

            if (isset($validated['streamer_id'])) {
                if ($streamer_spot && $streamer_spot->user_id != $validated['streamer_id']) {
                    $streamer_spot->delete();
                    $streamer_spot = null;
                }

                if (!$streamer_spot) {
                    $this->assign_user($match->id, $validated['streamer_id'], StaffRole::Streamer);
                }
            } else $streamer_spot?->delete();


            $commentator1_spot = TournamentMatchStaff::query()
                ->where('tournament_match_id', $match->id)
                ->where('role', '=', StaffRole::Commentator)
                ->first();

            $commentator2_spot = TournamentMatchStaff::query()
                ->where('tournament_match_id', $match->id)
                ->where('role', '=', StaffRole::Commentator);

            if ($commentator1_spot) {
                $commentator2_spot->where('user_id', '!=', $commentator1_spot->user_id);
            }

            $commentator2_spot = $commentator2_spot->first();

            $commentator1 = $validated['commentators'][0] ?? null;
            $commentator2 = $validated['commentators'][1] ?? null;

            if ($commentator1) {
                if ($commentator1_spot && $commentator1_spot->user_id != $commentator1) {
                    $commentator1_spot->delete();
                    $commentator1_spot = null;
                }

                if (!$commentator1_spot) {
                    $this->assign_user($match->id, $commentator1, StaffRole::Commentator);
                }
            } else $commentator1_spot?->delete();

            if ($commentator2) {
                if ($commentator2_spot && $commentator2_spot->user_id != $commentator2) {
                    $commentator2_spot->delete();
                    $commentator2_spot = null;
                }

                if (!$commentator2_spot) {
                    $this->assign_user($match->id, $commentator2, StaffRole::Commentator);
                }
            } else $commentator2_spot?->delete();

        } else {
            // Handle normal streamer and commentators

            if ($loggedUserRoles['streamer']) {
                $streamer_take = $validated['streamer_take'] ?? null;
                $streamer_resign = $validated['streamer_resign'] ?? null;

                if ($streamer_take || $streamer_resign) {
                    $streamer_spot = $this->match_spot($match->id, StaffRole::Streamer);

                    if ($streamer_take && !$streamer_spot) {
                        $this->assign_user($match->id, $loggedUser->id, StaffRole::Streamer);
                        $this->assigned_success();
                    } else {
                        $this->spot_taken();
                    }

                    if ($streamer_resign && $streamer_spot && $streamer_spot->user_id == $loggedUser->id) {
                        $streamer_spot->delete();
                        $this->discharge_success();
                    }
                }
            }
        }

        return back();
    }

    public function destroy(Request $request, Tournament $tournament, TournamentStageRound $round, TournamentMatch $match)
    {
        $this->authorize('delete', $tournament);

        // Check if lobby is empty
        if (count($match->ffaParticipants)) {
            createToast('error', '', __('Lobby has players in it!'), false);
            return back();
        }

        $match->delete();

        return redirect(route('web.tournaments.rounds.show', ['tournament' => $tournament->slug, 'round' => $round->id]));
    }

    private function match_spot($match_id, $role)
    {
        return TournamentMatchStaff::query()
            ->where('tournament_match_id', $match_id)
            ->where('role', '=', $role)
            ->first();
    }

    private function assign_user($match_id, $user_id, $role)
    {
        return TournamentMatchStaff::create([
            'tournament_match_id' => $match_id,
            'user_id' => $user_id,
            'role' => $role
        ]);
    }

    private function assigned_success()
    {
        createToast('success', '', __('Successfully assigned to this lobby!'));
    }

    private function discharge_success()
    {
        createToast('success', '', __('Successfully discharged from this lobby!'));
    }

    private function spot_free()
    {
        createToast('error', '', __('Spot is already free!'));
    }

    private function spot_taken()
    {
        createToast('error', '', __('Spot is already taken!'));
    }
}
