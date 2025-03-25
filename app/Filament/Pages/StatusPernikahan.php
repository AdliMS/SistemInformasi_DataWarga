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
        return [
            Select::make('category_id')
                ->label('Kategori')
                ->options([
                    1 => 'Option 1',
                    2 => 'Option 2',
                    3 => 'Option 3',
                ])
        ];
    }
}
