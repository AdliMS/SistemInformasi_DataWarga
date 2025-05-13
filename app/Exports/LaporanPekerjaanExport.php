<?php

namespace App\Exports;

use App\Models\Civilian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanPekerjaanExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Civilian::query()
            ->when($this->filters['selectedJob'] ?? null, function ($q, $selectedJob) {
                $q->whereHas('civilian_jobs', fn($q2) => $q2->where('civilian_jobs.id', $selectedJob));
            })
            ->when($this->filters['searchName'] ?? null, function ($q, $searchName) {
                $q->where('full_name', 'like', '%'.$searchName.'%');
            })
            ->with('civilian_jobs');

        $civilians = $query->get();

        $rows = [];

        foreach ($civilians as $civilian) {
            foreach ($civilian->civilian_jobs as $job) {
                $rows[] = [
                    'Tempat Kerja' => $job->job_place,
                    'Nama' => $civilian->full_name,
                    'Tahun Masuk' => $job->pivot->accepted_date,
                    'Tahun Berlangsung' => $job->pivot->retirement_date,
                ];
            }
        }

        return new Collection($rows);
    }

    public function headings(): array
    {
        return ['Tempat Kerja', 'Nama', 'Tahun Masuk', 'Tahun Berlangsung'];
    }
}
