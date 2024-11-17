<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory; // Tambahkan trait ini untuk mendukung penggunaan factory

    protected $fillable = [
        'temperature',
        'water_level',
        'battery_level',
        'status',
        'smoke_level',
        'device_id',
    ];

    protected $casts = [
        'temperature' => 'float',
        'water_level' => 'float',
        'battery_level' => 'float',
        'smoke_level' => 'float',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    // // Setter untuk temperature
    // public function setTemperatureAttribute($value)
    // {
    //     $this->attributes['temperature'] = $value;
    //     $this->updateStatus();
    // }

    // // Setter untuk water_level
    // public function setWaterLevelAttribute($value)
    // {
    //     $this->attributes['water_level'] = $value;
    //     $this->updateStatus();
    // }

    // // Setter untuk fire_detection
    // public function setFireDetectionAttribute($value)
    // {
    //     $this->attributes['smoke_level'] = $value;
    //     $this->updateStatus();
    // }

    // // Metode untuk memperbarui status
    // public function updateStatus()
    // {
    //     if ($this->temperature > 30 || $this->water_level < 80 || $this->smoke_level > 20 || $this->battery_level < 80) {
    //         $this->status = 'warning';
    //     } else if ($this->temperature > 40 || $this->water_level < 60 || $this->smoke_level > 0 || $this->battery_level < 60) {
    //         $this->status = 'danger';
    //     } else {
    //         $this->status = 'normal';
    //     }
    // }
}
