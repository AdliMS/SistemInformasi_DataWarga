<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;

class PaymentTracker extends Page
{
    
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Iuran';
    protected static ?string $navigationLabel = 'Pembayaran';
    protected static string $view = 'filament.pages.payment-tracker';

    public function getHeading(): string|Htmlable
    {
        return 'Pembayaran Iuran';
    }

    
}
