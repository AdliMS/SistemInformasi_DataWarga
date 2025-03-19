<?php

namespace App\Filament\Resources\DataTanggunganResource\Pages;

use App\Filament\Resources\DataTanggunganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataTanggungans extends ListRecords
{
    protected static string $resource = DataTanggunganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
