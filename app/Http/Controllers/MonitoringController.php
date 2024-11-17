<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        // Fetch all devices with latest log
        $devices = Device::with(['latestLog' => function ($query) {
            $query->latest(); // Ambil log terbaru
        }])->get();

        return view('monitoring', compact('devices'));
    }

    public function getDeviceLogsForChart($deviceId)
    {
        // Fetch last 7 logs for chart data, ordered chronologically
        $logs = Device::findOrFail($deviceId)->logs()
            ->latest()
            ->take(7)
            ->orderBy('created_at', 'asc') // Ensure chronological order
            ->get(['temperature', 'smoke_level', 'created_at'])
            ->map(function ($log) {
                return [
                    'temperature' => $log->temperature,
                    'smoke_level' => $log->smoke_level,
                    'time' => Carbon::parse($log->created_at)->format('H:i') // Short format for chart
                ];
            });

        return response()->json($logs);
    }

    public function getDeviceLogsForTable($deviceId)
    {
        // Fetch last 20 logs for table, ordered chronologically
        $logs = Device::findOrFail($deviceId)->logs()
            ->latest()
            ->take(20)
            ->orderBy('created_at', 'asc') // Ensure chronological order
            ->get(['temperature', 'smoke_level', 'battery_level', 'water_level', 'created_at'])
            ->map(function ($log) {
                return [
                    'temperature' => $log->temperature,
                    'smoke_level' => $log->smoke_level,
                    'battery_level' => $log->battery_level,
                    'water_level' => $log->water_level,
                    'time_full' => Carbon::parse($log->created_at)->format('d M y, H:i') // Full format for table log
                ];
            });

        return response()->json($logs);
    }



    public function getDeviceDetails($deviceId)
    {
        // Fetch the selected device with latest log
        $device = Device::with('latestLog')->findOrFail($deviceId);

        return response()->json([
            'name' => $device->name,
            'location' => $device->location,
            'temperature' => $device->latestLog->temperature ?? '-',
            'battery_level' => $device->latestLog->battery_level ?? '-',
            'water_level' => $device->latestLog->water_level ?? '-',
            'smoke_level' => $device->latestLog->smoke_level ?? '-',
            'status' => $device->latestLog->status ?? '-',
            'last_update' => $device->latestLog ? Carbon::parse($device->latestLog->created_at)->format('H:i:s') : '-'
        ]);
    }
}
