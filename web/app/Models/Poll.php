<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $table = 'polls';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'start_at',
        'end_at',
        'multiple_choice',
    ];

    protected static function booted()
    {
        static::creating(function ($poll) {
            if (Auth::check() && empty($poll->user_id)) {
                $poll->user_id = Auth::id();
            }
        });
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
    
    public function tokens()
    {
        return $this->hasMany(Token::class);
    }
    
    
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
