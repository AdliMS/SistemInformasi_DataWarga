<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class LaporanKegiatan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Kegiatan';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?string $label = 'Laporan Kegiatan';
    protected static string $view = 'filament.pages.laporan-kegiatan';
}
