<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScoreResource\Pages;
use App\Filament\Resources\ScoreResource\RelationManagers;
use App\Models\Score;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScoreResource extends Resource
{
    protected static ?string $model = Score::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Analytics';
    protected static ?int $navigationSort = 2; // sort order in navigation
    protected static ?string $navigationLabel = 'Scores';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('username')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('score')
                    ->sortable()
                    ->formatStateUsing(fn($state) => number_format($state, 0, '.', ',')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Created At'),
            ])
            ->defaultSort('score', 'desc') // default sort by score descending
            ->filters([
                Tables\Filters\SelectFilter::make('time_period')
                    ->label('Time Period')
                    ->options([
                        'this_week' => 'This Week (Mon 10am)',
                        'last_week' => 'Last Week',
                        'all_time' => 'All Time',
                    ])
                    ->default('this_week') // Set default to this week
                    ->query(function (Builder $query, array $data): Builder {
                        return match ($data['value'] ?? 'this_week') { // Change default from null to 'this_week'
                            'this_week' => $query->where('created_at', '>=', now()->startOfWeek()->addHours(10)),
                            'last_week' => $query->whereBetween('created_at', [
                                now()->subWeek()->startOfWeek()->addHours(10),
                                now()->startOfWeek()->addHours(10)
                            ]),
                            'all_time' => $query, // Show all records
                            default => $query->where('created_at', '>=', now()->startOfWeek()->addHours(10)), // Default fallback
                        };
                    }),
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
            'index' => Pages\ListScores::route('/'),
            // 'create' => Pages\CreateScore::route('/create'),
            // 'edit' => Pages\EditScore::route('/{record}/edit'),
        ];
    }
}
