<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Civilian;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanPernikahanExport implements FromCollection, WithHeadings
{
    protected $status;
    protected $name;

    public function __construct($status = null, $name = null)
    {
        $this->status = $status;
        $this->name = $name;
    }

    public function collection()
    {
        $query = Civilian::query();

        if ($this->status === 'sudah_menikah') {
            $query->where('married_status', true);
        } elseif ($this->status === 'belum_menikah') {
            $query->where('married_status', false);
        }

        if (!empty($this->name)) {
            $query->where('full_name', 'like', '%' . $this->name . '%');
        }

        $civilians = $query->get();

        return $civilians->map(function ($civ) {
            return [
                'status_pernikahan' => $civ->married_status ? 'Sudah menikah' : 'Belum menikah',
                'nama_lengkap' => $civ->full_name,
                'umur' => Carbon::parse($civ->born_date)->age . ' tahun',
                'jenis_kelamin' => $civ->gender ? 'Wanita' : 'Pria',
                'no_hp' => $civ->phone_number,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Status pernikahan',
            'Nama lengkap',
            'Umur',
            'Jenis kelamin',
            'No HP',
        ];
    }
}

