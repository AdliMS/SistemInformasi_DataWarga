<?php

namespace App\Filament\Resources\LaporanPekerjaanResource\Pages;

use App\Filament\Resources\LaporanPekerjaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporanPekerjaan extends EditRecord
{
    protected static string $resource = LaporanPekerjaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
