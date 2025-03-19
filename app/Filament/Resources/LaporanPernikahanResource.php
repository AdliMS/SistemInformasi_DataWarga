<?php

namespace App\Filament\Resources;

use Filament\Panel;
use Filament\Forms;
use Filament\Tables;
use App\Models\Civilian;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use App\Models\LaporanPernikahan;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LaporanPernikahanResource\Pages;
use App\Filament\Resources\LaporanPernikahanResource\RelationManagers;

class LaporanPernikahanResource extends Resource
{
    protected static ?string $model = Civilian::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Status Pernikahan';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?string $label = 'Laporan Status Pernikahan';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('married_status')
                ->label('Status pernikahan')
                ->formatStateUsing(function ($state, Civilian $civilian) {
                    if ($civilian->married_status == false) {
                        return 'Belum menikah';
                    }
                    return 'Sudah menikah';
                }),
            TextColumn::make('full_name')
                ->label('Nama lengkap'),
                TextColumn::make('born_date')
                ->label('Umur')
                ->formatStateUsing(function ($state, Civilian $civilian) {
                    return Carbon::parse($civilian->born_date)->age . ' ' . 'tahun';
                }),
            TextColumn::make('gender')
                ->label('Jenis kelamin')
                ->formatStateUsing(function ($state, Civilian $civilian) {
                    if ($civilian->gender == false) {
                        return 'Pria';
                    }
                    return 'Wanita';
                }),
            TextColumn::make('born_place')
                ->label('Tempat tanggal lahir')
                ->formatStateUsing(function ($state, Civilian $civilian) {
                    return $civilian->born_place . ', ' . Carbon::parse($civilian->born_date)->format('j F o');
                }),
            TextColumn::make('nik')
                ->label('NIK'),
            TextColumn::make('home_address')
                ->label('Alamat'),
            TextColumn::make('phone_number')
                ->label('No. HP'),
            TextColumn::make('Civilian_jobs.job_place')
                ->label('Pekerjaan'),
            TextColumn::make('liabilities.full_name')
                ->label('Tanggungan'),
                TextColumn::make('categories.name')
                ->label('Kategori'),
        ])
        ->filters([
            
        ]);
        // ->actions([
        //     Tables\Actions\EditAction::make(),
        //     Tables\Actions\DeleteAction::make(),
        // ])
        // ->bulkActions([
        //     Tables\Actions\BulkActionGroup::make([]),
        // ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaporanPernikahans::route('/'),
            'create' => Pages\CreateLaporanPernikahan::route('/create'),
            'edit' => Pages\EditLaporanPernikahan::route('/{record}/edit'),
        ];
    }
}
