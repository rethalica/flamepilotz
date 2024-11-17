<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\Log;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mengambil semua device yang ada di database
        $devices = Device::all();

        // Mengiterasi setiap device dan membuat data Log untuk masing-masing
        foreach ($devices as $device) {
            Log::factory()->create([
                'device_id' => $device->id, // Mengaitkan log dengan device yang ada
            ]);
        }
    }
}
