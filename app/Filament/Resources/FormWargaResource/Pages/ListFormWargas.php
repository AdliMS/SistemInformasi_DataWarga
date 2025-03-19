<?php

namespace App\Filament\Resources\FormWargaResource\Pages;

use App\Filament\Resources\FormWargaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormWargas extends ListRecords
{
    protected static string $resource = FormWargaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
