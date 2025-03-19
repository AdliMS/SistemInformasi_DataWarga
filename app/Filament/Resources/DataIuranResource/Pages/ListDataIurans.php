<?php

namespace App\Filament\Resources\DataIuranResource\Pages;

use App\Filament\Resources\DataIuranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataIurans extends ListRecords
{
    protected static string $resource = DataIuranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
