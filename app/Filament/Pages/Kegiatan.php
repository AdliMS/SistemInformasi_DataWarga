<?php

namespace App\Filament\Pages;

use App\Models\Activity;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Kegiatan extends Page
{
    protected static ?string $model = Activity::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Kegiatan';
    protected static ?string $navigationLabel = 'Kegiatan Warga';

    protected static string $view = 'filament.pages.kegiatan';

    public function getHeading(): string|Htmlable
    {
        return 'Kegiatan Warga';
    }
}
