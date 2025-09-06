<?php

namespace App\Livewire;

use App\Models\Token;
use Livewire\Component;

class Login extends Component
{
    public string $token = '';

    public function submit()
    {
        $token = Token::where('token', $this->token)->first();

        if (! $token) {
            return $this->addError('token', 'Token tidak valid.');
        }

        if ($token->used_at) {
            return $this->addError('token', 'Token sudah digunakan.');
        }

        return redirect()->route('voter.poll', ['token' => $token->token]);
    }
    
    public function render()
    {
        return view('livewire.login');
    }
}
