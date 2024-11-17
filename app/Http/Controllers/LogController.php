<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LogController extends Controller
{
    public function generateLogs()
    {
        // Ambil waktu terakhir generate log dari cache
        $lastLogTime = Cache::get('last_log_generated_time');

        // Jika belum pernah ada log atau lebih dari 1 menit sejak log terakhir, buat log baru
        if (!$lastLogTime || Carbon::parse($lastLogTime)->lt(Carbon::now()->subMinute())) {
            // Mengambil semua device
            $devices = Device::all();

            foreach ($devices as $device) {
                Log::factory()->create([
                    'device_id' => $device->id,
                ]);
            }

            // Set cache dengan waktu sekarang
            Cache::put('last_log_generated_time', Carbon::now(), 60); // Cache berlaku selama 60 detik

            return response()->json(['status' => 'success', 'message' => 'Logs generated successfully']);
        }

        return response()->json(['status' => 'skipped', 'message' => 'Logs already generated recently']);
    }
}
