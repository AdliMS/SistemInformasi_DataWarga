<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Civilian;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanKategoriExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $filterCategoryId = $this->filters['category_id'] ?? null;
        $search = $this->filters['search'] ?? null;

        $civilians = Civilian::query()
            ->with('categories')
            ->when($filterCategoryId, function ($q) use ($filterCategoryId) {
                $q->whereHas('categories', function ($subQ) use ($filterCategoryId) {
                    $subQ->where('categories.id', $filterCategoryId);
                });
            })
            ->when($search, function ($q) use ($search) {
                $q->where('full_name', 'like', '%' . $search . '%');
            })
            ->get();

        return new Collection($civilians->map(function ($civilian) use ($filterCategoryId) {
            // Ambil hanya nama kategori yang sesuai filter
            $filteredCategory = $civilian->categories->firstWhere('id', $filterCategoryId);
            $kategori = $filteredCategory ? $filteredCategory->name : '-';

            // Hitung umur secara positif dan bulat
            $umur = $civilian->born_date ? Carbon::parse($civilian->born_date)->age : '-';

            // Mapping jenis kelamin
            $gender = $civilian->gender === 1 ? 'Wanita' : 'Pria';

            return [
                'kategori' => $kategori,
                'full_name' => $civilian->full_name,
                'umur' => $umur,
                'gender' => $gender,
                'phone_number' => $civilian->phone_number,
            ];
        }));
    }

    public function headings(): array
    {
        return ['Kategori', 'Nama lengkap', 'Umur', 'Jenis kelamin', 'No. HP'];
    }
}
