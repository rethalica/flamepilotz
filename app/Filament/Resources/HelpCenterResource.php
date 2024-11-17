<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HelpCenterResource\Pages;
use App\Filament\Resources\HelpCenterResource\RelationManagers;
use App\Models\HelpCenter;
use DeepCopy\Filter\Filter;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HelpCenterResource extends Resource
{
    protected static ?string $model = HelpCenter::class;

    protected static ?string $navigationGroup = 'User Management';
    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('User ID')
                    ->required()
                    ->placeholder('Select User'),
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'resolved' => 'Resolved',
                    ])
                    ->required(),
                // Forms\Components\Toggle::make('is_public')
                //     ->label('Is Public')
                //     ->default(false),
                Forms\Components\Textarea::make('response')
                    ->label('Response'),

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
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->sortable()
                    ->limit(10),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->sortable(),
                // Tables\Columns\ToggleColumn::make('is_public')
                //     ->label('Public')
                //     ->sortable(),
                Tables\Columns\TextColumn::make('response')
                    ->searchable()
                    ->sortable()
                    ->limit(10),
                Tables\Columns\TextColumn::make('created_at')
                    ->date('d M Y, H:i')
                    ->searchable()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'resolved' => 'Resolved',
                    ])
                    ->label('Status'),
                // Tables\Filters\SelectFilter::make('is_public')
                //     ->options([
                //         '1' => 'Public',
                //         '0' => 'Private',
                //     ])
                //     ->label('Public'),
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
            'index' => Pages\ListHelpCenters::route('/'),
            'create' => Pages\CreateHelpCenter::route('/create'),
            'edit' => Pages\EditHelpCenter::route('/{record}/edit'),
        ];
    }
}
