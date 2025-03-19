<?php

namespace App\Filament\Resources;

use Filament\Panel;
use Filament\Forms;
use Filament\Tables;
use App\Models\Civilian;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use App\Models\LaporanKategori;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LaporanKategoriResource\Pages;
use App\Filament\Resources\LaporanKategoriResource\RelationManagers;

class LaporanKategoriResource extends Resource
{
    protected static ?string $model = Civilian::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?string $navigationLabel = 'Kategori';
    protected static ?string $label = 'Laporan Kategori';

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
                TextColumn::make('categories.name')
                    ->label('Kategori'),
                TextColumn::make('full_name')
                    ->label('Nama lengkap')
                    ->searchable(),
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
                TextColumn::make('married_status')
                    ->label('Status pernikahan')
                    ->formatStateUsing(function ($state, Civilian $civilian) {
                        if ($civilian->married_status == false) {
                            return 'Belum menikah';
                        }
                        return 'Sudah menikah';
                    }),
                TextColumn::make('phone_number')
                    ->label('No. HP'),
                TextColumn::make('civilian_jobs.job_place')
                    ->label('Pekerjaan'),
                TextColumn::make('liabilities.full_name')
                    ->label('Tanggungan'),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->columnSpan(3)
                    ->relationship('categories', 'name')
                    ->preload(),
            ])
            ->actions([

                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
                // ActionGroup::make([
                //     Action::make('sempaja'),
                //     Action::make('perjuangan'),
                //     Action::make('lambung'),

                // ])
                //     ->label('Kategori warga')
                //     ->icon('heroicon-m-ellipsis-vertical')
                //     ->size(ActionSize::Small)
                //     ->color('primary')
                //     ->button()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
            ]);
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
            'index' => Pages\ListLaporanKategoris::route('/'),
            'create' => Pages\CreateLaporanKategori::route('/create'),
            'edit' => Pages\EditLaporanKategori::route('/{record}/edit'),
        ];
    }
}
