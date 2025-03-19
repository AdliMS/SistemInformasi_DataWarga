<?php

namespace App\Filament\Resources;

use Filament\Panel;
use Filament\Forms;
use Filament\Tables;
use App\Models\Civilian;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\CivilianJob;
use Illuminate\Support\Carbon;
use App\Models\LaporanPekerjaan;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table\Concerns\HasFilters;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LaporanPekerjaanResource\Pages;
use App\Filament\Resources\LaporanPekerjaanResource\RelationManagers;

class LaporanPekerjaanResource extends Resource
{
    protected static ?string $model = Civilian::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pekerjaan';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?string $label = 'Laporan Pekerjaan';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                // Select::make('category_id')
                //     // ->required()
                //     ->label('Kategori keahlian')
                //     ->columnSpan(3)
                //     ->multiple()
                //     // ->disabled()
                //     ->relationship('categories', 'name')
                //     ->preload(),
                // TextInput::make('full_name')
                //     ->required()
                //     ->label('Nama lengkap'),
                // TextInput::make('age')
                //     ->required()
                //     ->label('Umur'),
                // Select::make('gender')
                //     ->required()
                //     ->label('Jenis kelamin')
                //     ->options([
                //         0 => "Pria",
                //         1 => "Wanita"
                //     ]),
                // TextInput::make('born_place')
                //     ->required()
                //     ->label('Tempat lahir'),
                // DatePicker::make('born_date')
                //     ->required()
                //     ->label('Tanggal lahir'),
                // TextInput::make('nik')
                //     ->required()
                //     ->label('NIK'),
                // TextInput::make('home_address')
                //     ->required()
                //     ->label('Alamat'),
                // Select::make('married_status')
                //     ->required()
                //     ->label('Status pernikahan')
                //     ->options([
                //         false => "Belum menikah",
                //         true => "Sudah menikah"
                //     ]),
                // TextInput::make('phone_number')
                //     ->required()
                //     ->label('No. HP'),

                // Repeater::make('liabilities')
                //     ->required()
                //     ->label('Tanggungan')
                //     ->relationship()
                //     ->schema([
                //         TextInput::make('full_name')
                //             ->required()
                //             ->label('Nama tanggungan'),
                //         TextInput::make('age')
                //             ->required()
                //             ->label('Umur'),
                //         Select::make('gender')
                //             ->required()
                //             ->label('Jenis kelamin')
                //             ->options([
                //                 "Pria",
                //                 "Wanita"
                //             ]),
                //         Select::make('last_education')
                //             ->required()
                //             ->label('Pendidikan terakhir')
                //             ->options([
                //                 "SMA sederajat",
                //                 "D3",
                //                 "D4/S1",
                //                 "S2",
                //                 "S3",

                //             ])
                //     ]),

                // Repeater::make('civilian_jobs')
                //     ->required()
                //     ->label('Pekerjaan')
                //     ->relationship()
                //     ->schema([
                //         TextInput::make('job_place')
                //             ->required()
                //             ->label('Nama tempat/perusahaan'),
                //         Select::make('accepted_date')
                //             ->required()
                //             ->label('Tahun masuk')
                //             ->options([
                //                 "2010",
                //                 "2011",
                //                 "2012",
                //                 "2013",
                //                 "2014",
                //                 "2015",
                //                 "2016",
                //                 "2017",
                //                 "2018",
                //                 "2019",
                //                 "2020",
                //             ]),
                //         Select::make('retirement_date')
                //             ->required()
                //             ->label('Tahun berhenti')
                //             ->options([
                //                 "2015",
                //                 "2016",
                //                 "2017",
                //                 "2018",
                //                 "2019",
                //                 "2020",
                //                 "2021",
                //                 "2022",
                //                 "2023",
                //                 "2024",
                //                 "Sekarang",
                //             ])
                //     ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('civilian_jobs.job_place')
                    ->label('Pekerjaan'),
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
                TextColumn::make('liabilities.full_name')
                    ->label('Tanggungan')
                    ->searchable(),
                TextColumn::make('categories.name')
                    ->label('Kategori'),
            ])
            ->filters([
                // Filter::make('Jabatan')
                // ->form([
                //     Select::make('Civilian_job_id')
                //     ->label('Tempat kerja')
                //     ->relationship('Civilian_jobs', 'job_place')

                // ])
                // ->query(function (Builder $query): Builder {
                //     return $query->where('Civilian_jobs.position', 'Civilian_jobs.position');
                // }), //error

                // SelectFilter::make('Civilian_job_place')
                // ->relationship('Civilian_jobs', 'position')
                // ->baseQuery(fn(Builder $query, $state) => $state['value'] ? $query->where('position', '=', $state['value']) : $query),
                // SelectFilter::make('civilian_job_place')
                //     ->label('Tempat kerja')
                //     ->relationship(
                //         'Civilian_jobs',
                //         'job_place',
                //         fn(Builder $query) => $query->groupBy('job_place')
                //     ),
                SelectFilter::make('civilian_job_id')
                    ->label('Tempat kerja')
                    ->relationship('civilian_jobs', 'job_place')
                    ->options(function () {
                        return CivilianJob::distinct('job_place')->pluck('civilian_job.job_place')->flatten()->unique(column: 'job_place');
                    }), //problem here

                // SelectFilter::make('job_place')
                // ->label('Pekerjaan')
                // ->options(function () {
                //     // Ambil semua job_place dari tabel civilian_jobs
                //     return CivilianJob::pluck('job_place', 'job_place')->toArray();
                // })
                // ->query(function ($query, $data) {
                //     $value = $data['value'];

                //     // Filter berdasarkan job_place di tabel civilian_jobs
                //     return $query->whereHas('civilian_jobs', function ($q) use ($value) {
                //         $q->where('job_place', $value);
                //     });
                // })
                // ->indicator('Pekerjaan'),
            ]);

        // ->actions([
        //     Tables\Actions\EditAction::make(),
        // ])
        // ->bulkActions([
        //     Tables\Actions\BulkActionGroup::make([
        //         Tables\Actions\DeleteBulkAction::make(),
        //     ]),
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
            'index' => Pages\ListLaporanPekerjaans::route('/'),
            'create' => Pages\CreateLaporanPekerjaan::route('/create'),
            'edit' => Pages\EditLaporanPekerjaan::route('/{record}/edit'),
        ];
    }
}
