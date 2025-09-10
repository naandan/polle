<?php

namespace App\Livewire;

use App\Models\Token;
use Livewire\Component;
use Carbon\Carbon;

class Login extends Component
{
    public string $token = '';

    public function submit()
    {
        $token = Token::with('poll')->where('token', $this->token)->first();
        $poll  = $token?->poll;
        $now   = now();

        if (
            ! $token ||
            $token->used_at ||
            ! $poll ||
            ($poll->start_at && $now->lt($poll->start_at)) ||
            ($poll->end_at && $now->gt($poll->end_at))
        ) {
            return $this->addError('token', 'Token tidak valid atau tidak dapat digunakan.');
        }

        return redirect()->route('voter.poll', ['token' => $token->token]);
    }

    
    public function render()
    {
        return view('livewire.login');
    }
}
