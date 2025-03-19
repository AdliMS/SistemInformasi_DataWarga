<?php

namespace App\Filament\Resources\LaporanPekerjaanResource\Pages;

use Closure;
use Filament\Actions;
use Illuminate\Support\Facades\Blade;
use Filament\Resources\Components\Tab;
use Filament\Tables\Filters\BaseFilter;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Facades\FilamentView;
use Filament\Tables\View\TablesRenderHook;
use App\Filament\Resources\LaporanPekerjaanResource;
use App\Models\CivilianJob;

class ListLaporanPekerjaans extends ListRecords
{
    protected static string $resource = LaporanPekerjaanResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    /**
     * @return array<string, BaseFilter>
     */


    // public function getTabs(): array
    // {

    //     // Ambil semua pekerjaan dari tabel jobs
    //     $jobs = CivilianJob::all();

    //     // Buat array untuk menyimpan tab
    //     $tabs = [
    //         'all' => Tab::make('All'), // Tab default untuk menampilkan semua data
    //     ];

    //     // Loop melalui setiap pekerjaan dan buat tab
    //     foreach ($jobs as $job) {
    //         $tabs[$job->id] = Tab::make($job->job_place)
    //             ->modifyQueryUsing(function ($query) use ($job) {
    //                 return $query->whereHas('civilian_jobs', function ($q) use ($job) {
    //                     $q->where('job_place', $job->job_place); // Filter berdasarkan job_place
    //                 });
    //             });
    //     }

    //     return $tabs;
    // }
}
