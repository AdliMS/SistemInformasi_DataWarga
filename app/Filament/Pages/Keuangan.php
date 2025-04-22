<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\CivilianPivotSubscription;
use Illuminate\Contracts\Support\Htmlable;

class Keuangan extends Page
{
    protected static ?string $model = CivilianPivotSubscription::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Iuran';
    protected static ?string $navigationLabel = 'Keuangan';

    protected static string $view = 'filament.pages.keuangan';

    public function getHeading(): string|Htmlable
    {
        return 'Keuangan';
    }
}
