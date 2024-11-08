<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpCenter extends Model
{
    protected $fillable = ['title', 'description', 'user_id', 'status', 'is_public', 'response'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
