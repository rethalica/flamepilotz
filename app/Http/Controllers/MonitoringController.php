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

    // Function to fetch logs dynamically for a device for the chart
    public function getDeviceLogs($deviceId)
    {
        // Fetch last 5 logs for chart data, ordered chronologically
        $logs = Device::findOrFail($deviceId)->logs()
            ->latest()
            ->take(10)
            ->orderBy('created_at', 'asc') // Ensure chronological order
            ->get(['temperature', 'smoke_level', 'created_at'])
            ->map(function ($log) {
                return [
                    'temperature' => $log->temperature,
                    'smoke_level' => $log->smoke_level,
                    'time' => Carbon::parse($log->created_at)->format('H:i') // Format time for chart
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
