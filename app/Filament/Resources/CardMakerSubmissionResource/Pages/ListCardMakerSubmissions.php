<?php

namespace App\Filament\Resources\CardMakerSubmissionResource\Pages;

use App\Filament\Resources\CardMakerSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCardMakerSubmissions extends ListRecords
{
    protected static string $resource = CardMakerSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
