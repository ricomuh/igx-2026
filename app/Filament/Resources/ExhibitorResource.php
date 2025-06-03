<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExhibitorResource\Pages;
use App\Filament\Resources\ExhibitorResource\RelationManagers;
use App\Models\Exhibitor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExhibitorResource extends Resource
{
    protected static ?string $model = Exhibitor::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make([
                    'default' => 2,
                ])
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Name'),
                        Forms\Components\TextInput::make('url')
                            ->url()
                            ->nullable()
                            ->maxLength(255)
                            ->label('URL'),
                    ]),
                Forms\Components\Grid::make([
                    'default' => 1,
                ])
                    ->schema([

                        Forms\Components\FileUpload::make('image_url')
                            ->image()
                            ->disk('public')
                            ->directory('exhibitors/images')
                            ->multiple(false)
                            ->required(fn($context) => $context === 'create')
                            ->label('Image'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Image')
                    ->disk('public')
                    ->default('exhibitors/images/default.png')
                    ->circular()
                    ->size(50),
                // Tables\Columns\TextColumn::make('image_url')
                //     ->label('Image URL'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->url(fn(Exhibitor $record): ?string => $record->url ?: null)
                    ->searchable()
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
            'index' => Pages\ListExhibitors::route('/'),
            'create' => Pages\CreateExhibitor::route('/create'),
            'edit' => Pages\EditExhibitor::route('/{record}/edit'),
        ];
    }
}
