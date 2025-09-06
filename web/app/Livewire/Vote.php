<?php

namespace App\Livewire;

use App\Models\Vote as ModelVote;
use App\Models\Token;
use Livewire\Component;

class Vote extends Component
{
    public $token;
    public $selected = []; // jangan pakai array typehint

    public function mount($token)
    {
        $this->token = Token::with('poll.options')->where('token', $token)->firstOrFail();

        if ($this->token->used_at) {
            abort(403, 'Token sudah digunakan.');
        }
    }

    public function submit()
    {
        $poll = $this->token->poll;

        if (empty($this->selected)) {
            $this->addError('selected', 'Pilih minimal 1 opsi.');
            return;
        }

        $selectedOptions = is_array($this->selected) ? $this->selected : [$this->selected];

        foreach ($selectedOptions as $optionId) {
            ModelVote::create([
                'poll_id' => $poll->id,
                'option_id' => $optionId,
                'token_id' => $this->token->id,
            ]);
        }

        $this->token->update(['used_at' => now()]);

        return redirect()->route('voter.login')->with('success', 'Vote berhasil disimpan.');
    }

    public function render()
    {
        $poll = $this->token->poll;
        return view('livewire.vote', compact('poll'));
    }
}

