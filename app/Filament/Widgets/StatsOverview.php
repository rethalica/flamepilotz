<?php

namespace App\Filament\Widgets;

use App\Models\Device;
use App\Models\HelpCenter;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected static ?string $pollingInterval = '15s';

    protected static bool $isLazy = true;

    protected function getStats(): array
    {
        // Get total users
        $totalUsers = User::count();

        // Get count of users by role
        $adminCount = User::where('role', 'admin')->count();
        $employeeCount = User::where('role', 'employee')->count();

        // Get count of help centers
        $totalHelpCenters = HelpCenter::count();

        //get count of help 
        $helpRequested = HelpCenter::where('status', 'pending')->count();
        $helpPublished = HelpCenter::where('status', 'published')->count();

        // Combine requested and published into a single stat
        $helpCenterSummary = "Requested: $helpRequested, Published: $helpPublished";

        // Combine admin and employee counts into a single stat
        $userRoleSummary = "Admins: $adminCount, Employees: $employeeCount";

        return [
            Stat::make('Total Devices', Device::count()),
            Stat::make('Total Users', $totalUsers)
                ->description($userRoleSummary)
                ->color('info'), // Add description for role summary
            Stat::make('Help Center', $totalHelpCenters)
                ->description($helpCenterSummary)
                ->color('success'), // Add description for help center summary
        ];
    }
}
