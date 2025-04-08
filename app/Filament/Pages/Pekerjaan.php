<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;


class Pekerjaan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Pekerjaan';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?string $label = 'Laporan Pekerjaan';
    protected static string $view = 'filament.pages.pekerjaan';
}
