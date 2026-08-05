<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketTypeResource\Pages;
use App\Models\TicketType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TicketTypeResource extends Resource
{
    protected static ?string $model = TicketType::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Ticketing';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->label('Nama Tiket'),
                    Forms\Components\TextInput::make('slug')
                        ->maxLength(255)
                        ->label('Slug (kosongkan untuk auto)')
                        ->helperText('Otomatis dari nama jika dikosongkan.'),
                    Forms\Components\Textarea::make('description')
                        ->rows(3)
                        ->label('Deskripsi'),
                    Forms\Components\TextInput::make('price')
                        ->numeric()
                        ->required()
                        ->prefix('Rp')
                        ->label('Harga'),
                    Forms\Components\TextInput::make('capacity')
                        ->numeric()
                        ->minValue(1)
                        ->label('Kuota (kosongkan = unlimited)'),
                    Forms\Components\TextInput::make('sort')
                        ->numeric()
                        ->default(0)
                        ->label('Urutan'),
                    Forms\Components\Toggle::make('is_active')
                        ->default(true)
                        ->label('Aktif (tampil di halaman tiket)'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('soldCount')
                    ->label('Terjual')
                    ->state(fn (TicketType $record): string => $record->capacity
                        ? "{$record->soldCount()}/{$record->capacity}"
                        : (string) $record->soldCount()),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->defaultSort('sort')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->trueLabel('Aktif')
                    ->falseLabel('Nonaktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTicketTypes::route('/'),
            'create' => Pages\CreateTicketType::route('/create'),
            'edit' => Pages\EditTicketType::route('/{record}/edit'),
        ];
    }
}
