<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'temperature',
        'water_level',
        'battery_level',
        'status',
        'fire_detection',
        'device_id',
    ];

    protected $casts = [
        'temperature' => 'float',
        'water_level' => 'float',
        'battery_level' => 'float',
        'fire_detection' => 'boolean',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

     // Setter untuk temperature
    public function setTemperatureAttribute($value)
    {
        $this->attributes['temperature'] = $value;
        $this->updateStatus();
    }

     // Setter untuk water_level
    public function setWaterLevelAttribute($value)
    {
         $this->attributes['water_level'] = $value;
         $this->updateStatus();
     }
 
     // Setter untuk fire_detection
     public function setFireDetectionAttribute($value)
     {
         $this->attributes['fire_detection'] = $value;
         $this->updateStatus();
     }
 
     // Metode untuk memperbarui status
     protected function updateStatus()
     {
         // Cek semua kondisi untuk menentukan status
         if ($this->temperature > 40 || $this->water_level < 60 || $this->fire_detection) {
             $this->attributes['status'] = 'danger';
         } else {
             $this->attributes['status'] = 'normal'; // Atau status lain yang sesuai
         }
     }
}
