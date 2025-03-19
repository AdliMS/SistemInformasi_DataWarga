<?php

namespace App\Filament\Resources\DataTanggunganResource\Pages;

use App\Filament\Resources\DataTanggunganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataTanggungan extends EditRecord
{
    protected static string $resource = DataTanggunganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
