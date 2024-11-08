<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'name',
        'location',
    ];

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    // fungsi untuk mendapatkan 1 log terbaru
    public function latestLog()
    {
        return $this->hasOne(Log::class)->latestOfMany();
    }
}
