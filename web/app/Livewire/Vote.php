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
        $this->token = Token::with('poll.options')->where('token', $token)->first();

        $poll = $this->token?->poll;
        $now  = now();

        if (
            ! $this->token ||                         // token tidak ada
            $this->token->used_at ||                  // token sudah dipakai
            ! $poll ||                                // poll tidak ada
            ($poll->start_at && $now->lt($poll->start_at)) || // belum mulai
            ($poll->end_at && $now->gt($poll->end_at))        // sudah berakhir
        ) {
            abort(404);
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

        return redirect()->route('voter.success', ["token" => $this->token->token]);
    }

    public function render()
    {
        $poll = $this->token->poll;
        return view('livewire.vote', compact('poll'));
    }
}

