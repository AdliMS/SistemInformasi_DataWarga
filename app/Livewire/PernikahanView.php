<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Civilian;
use Livewire\WithPagination;

class PernikahanView extends Component
{

    use WithPagination;

    public $statusPernikahan = '';      // Menyimpan filter status pernikahan sementara
    public $selectedName = '';          // Menyimpan filter nama sementara
    public $appliedStatusFilter = '';   // Status pernikahan yang aktif
    public $appliedNameFilter = '';     // Nama yang aktif
    public $nameOptions = [];           // Daftar nama untuk selectbox

    // Update opsi nama saat status pernikahan berubah
    public function loadNameOptions()
    {
        $this->nameOptions = Civilian::query()
            ->when($this->statusPernikahan === 'sudah_menikah', fn($q) => $q->where('married_status', true))
            ->when($this->statusPernikahan === 'belum_menikah', fn($q) => $q->where('married_status', false))
            ->pluck('full_name', 'id')
            ->toArray();

        $this->selectedName = '';
    }

    // Terapkan filter saat tombol diklik
    public function applyFilter()
    {
        $this->appliedStatusFilter = $this->statusPernikahan;
        $this->appliedNameFilter = $this->selectedName;
    }

    public function render()
    {
        $query = Civilian::query();

        // Filter berdasarkan status pernikahan
        if ($this->appliedStatusFilter === 'sudah_menikah') {
            $query->where('married_status', true);
        } elseif ($this->appliedStatusFilter === 'belum_menikah') {
            $query->where('married_status', false);
        }

        // Filter berdasarkan nama (jika dipilih)
        if ($this->appliedNameFilter) {
            $query->where('id', $this->appliedNameFilter); // Filter by ID lebih akurat
        }

        $civilians = $query->get();

        return view('livewire.pernikahan-view', [
            'civilians' => $civilians,
            'nameOptions' => $this->nameOptions,
        ]);
    }
}
