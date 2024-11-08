<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'User Management';
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'employee' => 'Employee',
                    ])
                    ->default('employee')
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn (string $context) => $context === 'create')
                    ->minLength(8),
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
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\SelectColumn::make('role')
                ->options([
                    'admin' => 'Admin',
                    'employee' => 'Employee',
                ])
                ->inline()
                ->default('employee')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'employee' => 'Employee',
                    ])
                    ->label('Role'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('changeRole')
                    ->label('Change Role')
                    ->action(function (array $recordIds, array $data) {
                        User::whereIn('id', $recordIds)->update(['role' => $data['role']]);
                    })
                    ->form([
                        Forms\Components\Select::make('role')
                            ->options([
                                'admin' => 'Admin',
                                'employee' => 'Employee',
                            ])
                            ->required()
                            ->default('employee')
                    ])
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
