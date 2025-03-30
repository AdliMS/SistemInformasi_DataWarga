<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class LaporanIuran extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.laporan-iuran';
    protected static ?string $navigationLabel = 'Laporan';
    protected static ?string $navigationGroup = 'Iuran';
    protected static ?string $label = 'Laporan Iuran';
}
