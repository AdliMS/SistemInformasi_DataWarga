<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Components\Select;

class StatusPernikahan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.status-pernikahan';

    protected function getFormSchema(): array
    {
        return [];
    }
}
