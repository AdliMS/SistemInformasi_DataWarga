<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Civilian;
use Livewire\WithPagination;

class PernikahanView extends Component
{

    use WithPagination;

    public $statusPernikahan = '';
    public $searchName = '';
    public $appliedStatus = '';
    public $appliedName = '';
    public $perPage = 10;
    protected $queryString = ['appliedStatus', 'appliedName', 'page'];


    // Terapkan filter saat tombol diklik
    public function applyFilter()
    {
        $this->appliedStatus = $this->statusPernikahan;
        $this->appliedName = $this->searchName;
        $this->resetPage();
        // Tidak perlu emit karena kita menggunakan property langsung
    }

    public function exportToExcel()
    {
        session([
            'statusPernikahan' => $this->statusPernikahan,
            'searchName' => $this->searchName,
        ]);

        $this->dispatch('triggerExcelDownload');
    }

    public function render()
    {
        $query = Civilian::query();

        // Filter berdasarkan status yang diapply
        if ($this->appliedStatus === 'sudah_menikah') {
            $query->where('married_status', true);
        } elseif ($this->appliedStatus === 'belum_menikah') {
            $query->where('married_status', false);
        }

        // Filter berdasarkan nama yang diapply
        if (!empty($this->appliedName)) {
            $query->where('full_name', 'like', '%' . $this->appliedName . '%');
        }

        $civilians = $query->paginate($this->perPage);

        return view('livewire.pernikahan-view', [
            'civilians' => $civilians,
        ]);
    }
}
