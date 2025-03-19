<?php

namespace App\Filament\Resources\LaporanKategoriResource\Pages;

use App\Filament\Resources\LaporanKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporanKategori extends EditRecord
{
    protected static string $resource = LaporanKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
