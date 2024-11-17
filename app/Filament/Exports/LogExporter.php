<?php

namespace App\Filament\Exports;

use App\Models\Log;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class LogExporter extends Exporter
{
    protected static ?string $model = Log::class;

    public static function getColumns(): array
    {
        return [
            // ExportColumn::make('device.id')
            //     ->label('ID'),
            ExportColumn::make('device.name')
                ->label('Device Room'),
            ExportColumn::make('device.location')
                ->label('Device Location'),
            ExportColumn::make('temperature'),
            ExportColumn::make('battery_level'),
            ExportColumn::make('smoke_level'),
            ExportColumn::make('status'),
            ExportColumn::make('created_at'),

        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your log export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
