<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Http\Request;

class UserTournamentsController extends Controller
{

    public function show(Request $request, User $user)
    {
        $loggedUser = $request->attributes->get('loggedUser');
        $show_unlisted = false;

        if ($user->id === $loggedUser->id) {
            $seo['title'] = __('My Tournaments');
            $show_unlisted = true;
        } else {
            $seo['title'] = __(':user\'s Tournaments', ['user' => $user->username]);
        }

        $tournaments = Tournament::where('user_id', $user->id)->paginate(50);

        return view('web.user.tournaments', compact('tournaments', 'seo', 'user', 'show_unlisted'));
    }

}
