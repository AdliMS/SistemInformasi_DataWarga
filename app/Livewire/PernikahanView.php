<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Civilian;
use Livewire\WithPagination;

class PernikahanView extends Component
{

    use WithPagination;

    public $statusPernikahan = ''; // Menyimpan nilai sementara dari select box
    public $appliedFilter = '';    // Nilai filter yang aktif

    // Method untuk menerapkan filter
    public function applyFilter()
    {
        $this->appliedFilter = $this->statusPernikahan;
        $this->resetPage(); // Reset pagination jika digunakan
    }

    public function render()
    {
        $query = Civilian::query();

        // Filter berdasarkan nilai yang sudah diapply ($appliedFilter)
        if ($this->appliedFilter === 'sudah_menikah') {
            $query->where('married_status', true);
        } elseif ($this->appliedFilter === 'belum_menikah') {
            $query->where('married_status', false);
        }

        $civilians = $query->get(); // Ganti dengan paginate() jika perlu

        return view('livewire.pernikahan-view', [
            'civilians' => $civilians,
        ]);
    }
}
