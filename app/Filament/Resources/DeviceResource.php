<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeviceResource\Pages;
use App\Filament\Resources\DeviceResource\RelationManagers;
use App\Models\Device;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeviceResource extends Resource
{
    protected static ?string $model = Device::class;

    protected static ?string $navigationGroup = 'Device Management';
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(50)
                    ->unique('devices', 'name'),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No')
                    ->sortable()
                    ->getStateUsing(function (Tables\Columns\TextColumn $column, $record) {
                        return $column->getTable()->getRecords()->firstItem() + $column->getTable()->getRecords()->search($record);
                    }),
                Tables\Columns\TextColumn::make('name')->label('Room name')->sortable(),
                Tables\Columns\TextColumn::make('location')->label('Location')->sortable(),
                Tables\Columns\TextColumn::make('temperature')
                    ->label('Temperature')
                    ->getStateUsing(fn($record) => $record->logs()->latest()->value('temperature'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('water_level')
                    ->label('Water Level')
                    ->getStateUsing(fn($record) => $record->logs()->latest()->value('water_level'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('battery_level')
                    ->label('Battery Level')
                    ->getStateUsing(fn($record) => $record->logs()->latest()->value('battery_level'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('smoke_level')
                    ->label('Smoke Level')
                    ->getStateUsing(fn($record) => $record->logs()->latest()->value('smoke_level'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->getStateUsing(fn($record) => $record->logs()->latest()->value('status'))
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListDevices::route('/'),
            'create' => Pages\CreateDevice::route('/create'),
            'edit' => Pages\EditDevice::route('/{record}/edit'),
        ];
    }
}
