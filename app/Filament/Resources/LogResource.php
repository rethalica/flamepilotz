<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogResource\Pages;
use App\Filament\Resources\LogResource\RelationManagers;
use App\Models\Log;
use Carbon\Carbon;
use DeepCopy\Filter\Filter;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LogResource extends Resource
{
    protected static ?string $model = Log::class;

    protected static ?string $navigationGroup = 'Device Management';
    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('device_id')
                    ->relationship('device', 'name')
                    ->label('Device ID')
                    ->required()
                    ->placeholder('Select Device'),
                Forms\Components\TextInput::make('temperature')
                    ->label('Temp')
                    ->required()
                    ->suffix('°C')
                    ->placeholder('Temperature'),
                Forms\Components\TextInput::make('water_level')
                    ->label('Water Level')
                    ->required()
                    ->minValue(0)
                    ->maxValue(100)
                    ->suffix('%')
                    ->placeholder('Water Level'),
                Forms\Components\TextInput::make('battery_level')
                    ->label('Battery (%)')
                    ->minValue(0)
                    ->maxValue(100)
                    ->suffix('%')
                    ->required(),
                // Forms\Components\Select::make('status')
                //     ->label('Status')
                //     ->options([
                //         'normal' => 'Normal',
                //         'warning' => 'Warning',
                //         'danger' => 'Danger',
                //     ])
                //     ->required()
                //     ->placeholder('Select Status')
                //     ->default('normal'),
                Forms\Components\Checkbox::make('fire_detection')
                    ->label('Fire')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                ->label('No')
                ->sortable()
                ->getStateUsing(function (Tables\Columns\TextColumn $column, $record) {
                    return $column->getTable()->getRecords()->firstItem() + $column->getTable()->getRecords()->search($record);
                }),
            Tables\Columns\TextColumn::make('device.name') // Menampilkan nama perangkat
                ->label('Device Name')
                ->sortable(),
            Tables\Columns\TextColumn::make('device.location') // Menampilkan lokasi perangkat
                ->label('Location')
                ->sortable(),
            Tables\Columns\TextColumn::make('temperature')
                ->label('Temp (°C)')
                ->sortable(),
            Tables\Columns\TextColumn::make('water_level')
                ->label('Water Level (%)')
                ->sortable(),
            Tables\Columns\TextColumn::make('battery_level')
                ->label('Battery (%)')
                ->sortable(),
            Tables\Columns\TextColumn::make('status')
                ->label('Status')
                ->sortable(),
            Tables\Columns\IconColumn::make('fire_detection')
                ->label('Fire')
                ->boolean()
                ->trueColor('danger')
                ->falseColor('success')
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->label('logged at')
                ->getStateUsing(fn ($record) => Carbon::parse($record->created_at)->diffForHumans())
                ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('fire_detection')
                    ->options([
                        'true' => 'Fire Detected',
                        'false' => 'No Fire Detected',
                    ])
                    ->label('Fire'),
                Tables\Filters\SelectFilter::make('device_id')
                    ->relationship('device', 'name')
                    ->label('Device'),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'normal' => 'Normal',
                        'warning' => 'Warning',
                        'danger' => 'Danger',
                    ])
                    ->label('Status')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLogs::route('/'),
            'create' => Pages\CreateLog::route('/create'),
            'edit' => Pages\EditLog::route('/{record}/edit'),
        ];
    }
}
