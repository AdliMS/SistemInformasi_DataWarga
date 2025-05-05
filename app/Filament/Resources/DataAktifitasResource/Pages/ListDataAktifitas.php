<?php

namespace App\Filament\Resources\DataAktifitasResource\Pages;

use App\Filament\Resources\DataAktifitasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataAktifitas extends ListRecords
{
    protected static string $resource = DataAktifitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
