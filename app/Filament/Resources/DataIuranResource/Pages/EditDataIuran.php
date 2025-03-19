<?php

namespace App\Filament\Resources\DataIuranResource\Pages;

use App\Filament\Resources\DataIuranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataIuran extends EditRecord
{
    protected static string $resource = DataIuranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
