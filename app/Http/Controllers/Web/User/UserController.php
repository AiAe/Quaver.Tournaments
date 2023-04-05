<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function show(User $user)
    {
        // User profile
    }

    public function edit(Request $request) {
        $loggedUser = $request->attributes->get('loggedUser');
        $this->authorize('update', $loggedUser);

        return view('web.user.edit');
    }

    public function update(Request $request)
    {
        $loggedUser = \Auth::user();

        $this->authorize('update', $loggedUser);

        $validator = Validator::make($request->all(), [
            'timezone_offset' => ['required', 'numeric', 'between:-12,14']
        ]);

        $validator->validate();
        $validated = $validator->validated();

        $loggedUser->fill($validated);
        $loggedUser->save();

        createToast('success', '', __('Settings are saved successfully!'));

        return back();
    }
}
