<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class UserTournamentsController extends Controller
{

    public function show(Request $request, User $user)
    {
        $loggedUser = app('loggedUser');
        $show_unlisted = false;

        if ($user->id === $loggedUser->id) {
            $title = __('My Tournaments');
            $show_unlisted = true;
        } else {
            $title = __(':user\'s Tournaments', ['user' => $user->username]);
        }

        $tournaments = Tournament::where('user_id', $user->id)->paginate(50);

        $SEOData = new SEOData(
            title: e($title)
        );

        return view('web.user.tournaments', compact('tournaments', 'user', 'show_unlisted', 'SEOData', 'title'));
    }

}
