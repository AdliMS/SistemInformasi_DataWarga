<?php

namespace App\Filament\Resources\DataPekerjaanResource\Pages;

use App\Filament\Resources\DataPekerjaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataPekerjaan extends EditRecord
{
    protected static string $resource = DataPekerjaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
