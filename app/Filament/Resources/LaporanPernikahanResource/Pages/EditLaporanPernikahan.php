<?php

namespace App\Filament\Resources\LaporanPernikahanResource\Pages;

use App\Filament\Resources\LaporanPernikahanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporanPernikahan extends EditRecord
{
    protected static string $resource = LaporanPernikahanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
