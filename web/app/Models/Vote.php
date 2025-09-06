<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';

    protected $fillable = [
        'poll_id',
        'option_id',
        'token_id',
    ];
    
    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
    
    public function option()
    {
        return $this->belongsTo(Option::class);
    }
    
    public function token()
    {
        return $this->belongsTo(Token::class);
    }
    
}
