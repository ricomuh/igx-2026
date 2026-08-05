<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Ticketing';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_number')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('No. Order')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer_email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Order::STATUS_PENDING => 'warning',
                        Order::STATUS_WAITING_CONFIRMATION => 'info',
                        Order::STATUS_CONFIRMED => 'success',
                        Order::STATUS_CANCELLED => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        Order::STATUS_PENDING => 'Menunggu Bayar',
                        Order::STATUS_WAITING_CONFIRMATION => 'Menunggu Verifikasi',
                        Order::STATUS_CONFIRMED => 'Terkonfirmasi',
                        Order::STATUS_CANCELLED => 'Dibatalkan',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        Order::STATUS_PENDING => 'Menunggu Bayar',
                        Order::STATUS_WAITING_CONFIRMATION => 'Menunggu Verifikasi',
                        Order::STATUS_CONFIRMED => 'Terkonfirmasi',
                        Order::STATUS_CANCELLED => 'Dibatalkan',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Detail Order')
                    ->schema([
                        TextEntry::make('order_number')->label('No. Order'),
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                Order::STATUS_PENDING => 'warning',
                                Order::STATUS_WAITING_CONFIRMATION => 'info',
                                Order::STATUS_CONFIRMED => 'success',
                                Order::STATUS_CANCELLED => 'danger',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                Order::STATUS_PENDING => 'Menunggu Bayar',
                                Order::STATUS_WAITING_CONFIRMATION => 'Menunggu Verifikasi',
                                Order::STATUS_CONFIRMED => 'Terkonfirmasi',
                                Order::STATUS_CANCELLED => 'Dibatalkan',
                                default => $state,
                            }),
                        TextEntry::make('customer_name')->label('Nama'),
                        TextEntry::make('customer_email')->label('Email'),
                        TextEntry::make('customer_phone')->label('No. WA'),
                        TextEntry::make('total_amount')->label('Total')->money('IDR'),
                        TextEntry::make('payment_method')->label('Metode'),
                        TextEntry::make('paid_at')->label('Dibayar')->dateTime('d M Y H:i')->placeholder('—'),
                        TextEntry::make('admin_notes')->label('Catatan Admin')->placeholder('—'),
                        TextEntry::make('created_at')->label('Dibuat')->dateTime('d M Y H:i'),
                    ])
                    ->columns(2),
                Section::make('Item Tiket')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->schema([
                                TextEntry::make('ticket_name')->label('Tiket'),
                                TextEntry::make('qty')->label('Qty'),
                                TextEntry::make('unit_price')->label('Harga')->money('IDR'),
                                TextEntry::make('subtotal')->label('Subtotal')->money('IDR'),
                            ])
                            ->columns(4),
                    ]),
                Section::make('Pembayaran')
                    ->schema([
                        RepeatableEntry::make('payments')
                            ->schema([
                                TextEntry::make('reference_number')->label('Referensi'),
                                TextEntry::make('amount')->label('Jumlah')->money('IDR'),
                                TextEntry::make('status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'confirmed' => 'success',
                                        'rejected' => 'danger',
                                        default => 'warning',
                                    })
                                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                                ImageEntry::make('proof_path')
                                    ->label('Bukti Transfer')
                                    ->disk('proofs')
                                    ->height(200),
                                TextEntry::make('admin_note')->label('Catatan Admin')->placeholder('—'),
                            ])
                            ->columns(3),
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
            'index' => Pages\ListOrders::route('/'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }
}
