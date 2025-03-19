<?php

namespace App\Filament\Resources\LaporanPernikahanResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\LaporanPernikahanResource;

class ListLaporanPernikahans extends ListRecords
{
    protected static string $resource = LaporanPernikahanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array {
        return [
            'all' => Tab::make('All'),
            'sudah_menikah' => Tab::make('Sudah menikah')
            ->modifyQueryUsing(function ($query) {
                return $query->where('married_status', 1);
            }),
            'belum_menikah' => Tab::make('Belum menikah')
            ->modifyQueryUsing(function ($query) {
                return $query->where('married_status', 0);
            })
        ];
    }
}
