<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Kategori extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.kategori';
    protected static ?string $navigationLabel = 'Kategori';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?string $label = 'Laporan Kategori Warga';
    protected static ?string $slug = 'laporan-kategori-warga';
}
