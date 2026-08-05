<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('confirm')
                ->label('Konfirmasi Pembayaran')
                ->icon('heroicon-o-check-badge')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Konfirmasi pembayaran ini?')
                ->modalDescription('Order akan ditandai terkonfirmasi dan tiket aktif.')
                ->visible(fn (): bool => $this->record->status === Order::STATUS_WAITING_CONFIRMATION)
                ->action(function (): void {
                    $this->record->confirm();
                    $this->sendSuccessNotification('Pembayaran dikonfirmasi. Order terkonfirmasi.');
                }),
            Actions\Action::make('cancel')
                ->label('Batalkan Order')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Batalkan order ini?')
                ->modalDescription('Order akan dibatalkan. Tindakan ini tidak bisa dibatalkan.')
                ->visible(fn (): bool => in_array($this->record->status, [
                    Order::STATUS_PENDING,
                    Order::STATUS_WAITING_CONFIRMATION,
                ]))
                ->action(function (): void {
                    $this->record->update(['status' => Order::STATUS_CANCELLED]);
                    $this->sendSuccessNotification('Order dibatalkan.');
                }),
        ];
    }

    private function sendSuccessNotification(string $message): void
    {
        Notification::make()
            ->title($message)
            ->success()
            ->send();
    }
}
