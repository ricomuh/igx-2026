<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WinnerResource\Pages;
use App\Filament\Resources\WinnerResource\RelationManagers;
use App\Models\Winner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WinnerResource extends Resource
{
    protected static ?string $model = Winner::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Analytics';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Winners';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('score.username')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('score.email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('score.score')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn($state) => number_format($state, 0, '.', ',')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Created At'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListWinners::route('/'),
            // 'create' => Pages\CreateWinner::route('/create'),
            // 'edit' => Pages\EditWinner::route('/{record}/edit'),
        ];
    }
}
