<?php

namespace App\Http\Livewire\User;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Token extends Component
{
    use AuthorizesRequests;

    public string|null $new_token = null;

    public function generate_token()
    {
        $user = auth()->user();

        if($user->tokens()) {
            $user->tokens()->delete();
        }

        $this->new_token = $user->createToken('api')->plainTextToken;
    }

    public function render()
    {
        return view('livewire.user.token');
    }
}
