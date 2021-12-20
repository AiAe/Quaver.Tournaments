<?php

namespace App\Http\Controllers\Signup;

use App\Http\Controllers\Controller;
use App\Models\Forms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    private array $types = [
//        'player',
        'staff'
    ];

    public function staff()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Join Staff";

        return view('signup/staff', $pageData);
    }

    public function player()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Join Tournament";

        return view('signup/player', $pageData);
    }

    public function save(Request $request)
    {
        $type = $request->route('type');

        if(!in_array($type, $this->types)) {
            return redirect(route('signupStaff'))->with('error', 'Form type not found!');
        }

        $validator = Validator::make($request->all(), [
            'roles' => 'array|min:1|required',
            'previous_experience' => 'required'
        ]);

        $validator->validate();
        $validated = $validator->validated();

        Forms::create([
            'user_id' => Auth::user()->id,
            'data' => $validated,
            'type' => Forms::TYPE['staff']
        ]);

        return back()->with('success', 'You applied successfully!');
    }
}
