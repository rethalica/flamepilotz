<?php

use App\Filament\Resources\HelpCenterResource\Pages\RespondHelpCenter;
use App\Http\Controllers\HelpCenterController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home', function () {
    return view('home');
});

//route halaman panduan
Route::get('/panduan', function () {
    return view('panduan');
})->name('panduan');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk halaman utama monitoring
Route::get('/monitoring', [MonitoringController::class, 'index'])->middleware('auth')->name('monitoring');


// Route untuk mengambil log perangkat untuk grafik
Route::get('/monitoring/{deviceId}/logs', [MonitoringController::class, 'getDeviceLogs']);

// Route untuk mengambil detail perangkat
Route::get('/monitoring/{deviceId}/details', [MonitoringController::class, 'getDeviceDetails']);
Route::get('/monitoring/{deviceId}/logs-chart', [MonitoringController::class, 'getDeviceLogsForChart']);
Route::get('/monitoring/{deviceId}/logs-table', [MonitoringController::class, 'getDeviceLogsForTable']);

Route::get('/generate-logs', [LogController::class, 'generateLogs']);

Route::middleware('auth')->group(function () {
    Route::resource('helpcenter', HelpCenterController::class)->except('edit', 'update', 'destroy');
});



require __DIR__ . '/auth.php';
