<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Filament\Forms\Components\Select;
use App\Models\CivilianPivotSubscription;

class PaymentTracker extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.payment-tracker';
    protected static ?string $navigationGroup = 'Iuran';
    protected static ?string $navigationLabel = 'Pembayaran';

    
}
