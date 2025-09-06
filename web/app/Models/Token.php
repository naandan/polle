<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'tokens';

    protected $fillable = [
        'poll_id',
        'token',
        'voter_name',
        'used_at',
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
    
    
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
