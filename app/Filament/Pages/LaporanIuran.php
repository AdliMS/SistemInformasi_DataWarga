<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class LaporanIuran extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.laporan-iuran';
    protected static ?string $navigationLabel = 'Laporan';
    protected static ?string $navigationGroup = 'Iuran';
    protected static ?string $label = 'Laporan Iuran';
    protected static ?int $navigationSort = 3;
   protected static ?string $slug = 'laporan-iuran';
}
