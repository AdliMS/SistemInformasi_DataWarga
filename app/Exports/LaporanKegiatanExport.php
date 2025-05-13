<?php

namespace App\Exports;

use App\Models\Civilian;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanKegiatanExport implements FromArray, WithHeadings
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function headings(): array
    {
        return ['No.', 'Nama Warga', 'Kategori Warga', 'Nama Kegiatan', 'Input Kegiatan', 'Target', 'Keterangan'];
    }

    public function array(): array
    {
        $query = Civilian::with(['categories.activities', 'activities']);

        if (!empty($this->filters['selectedCategory'])) {
            $query->whereHas('categories', fn($q) =>
                $q->where('categories.id', $this->filters['selectedCategory'])
            );
        }

        if (!empty($this->filters['searchName'])) {
            $query->where('full_name', 'like', '%' . $this->filters['searchName'] . '%');
        }

        $data = [];
        $no   = 1;

        foreach ($query->get() as $civ) {
            $wargaDisplayed = false;

            // FILTER kategori warga terlebih dahulu
            $categories = $civ->categories;

            if (!empty($this->filters['selectedCategory'])) {
                $categories = $categories->filter(function ($cat) {
                    return $cat->id == $this->filters['selectedCategory'];
                });
            }

            // Kalau kosong setelah filter, kita lewati warga ini
            if ($categories->isEmpty()) {
                continue;
            }

            foreach ($categories as $cat) {
                $kategoriDisplayed = false;

                $allActs = $cat->activities;
                $pivotMapping = $civ->activities->pluck('pivot.progress', 'id');

                $acts = $allActs->map(function($a) use ($pivotMapping) {
                    $prog = $pivotMapping->get($a->id, 0);
                    $keterangan = $this->getKeterangan($prog, $a->target);

                    return [
                        'name'       => $a->name,
                        'progress'   => $prog ?: '-',
                        'target'     => $a->target,
                        'keterangan' => $keterangan['label'],
                    ];
                });

                if ($acts->isEmpty()) {
                    $acts = collect([[ 
                        'name' => '-', 'progress' => '-', 'target' => '-', 'keterangan' => 'KB'
                    ]]);
                }

                foreach ($acts as $act) {
                    $data[] = [
                        $wargaDisplayed ? '' : $no++,
                        $wargaDisplayed ? '' : $civ->full_name,
                        $kategoriDisplayed ? '' : $cat->name,
                        $act['name'],
                        $act['progress'],
                        $act['target'],
                        $act['keterangan'],
                    ];

                    $wargaDisplayed = true;
                    $kategoriDisplayed = true;
                }
            }
        }

        return $data;
    }

    private function getKeterangan($progress, $target)
    {
        if ($target <= 0) {
            return ['label' => 'N/A'];
        }

        $percentage = ($progress / $target) * 100;

        return match (true) {
            $percentage >= 100 => ['label' => 'B'],
            default => ['label' => 'KB'],
        };
    }
}
