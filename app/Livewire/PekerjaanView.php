<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Civilian;
use App\Models\CivilianJob;
use Livewire\WithPagination;

class PekerjaanView extends Component
{
    use WithPagination;

    public $selectedJob = '';
    public $searchName = '';
    public $jobs = [];

    public function mount()
    {
        $this->jobs = CivilianJob::all();
    }

    public function applyFilter()
    {
        $this->resetPage();
    }

    public function exportToExcel()
    {
        session([
            'laporan_pekerjaan_filter' => [
                'selectedJob' => $this->selectedJob,
                'searchName' => $this->searchName,
            ],
        ]);
        $this->dispatch('triggerExcelDownload');
    }


    public function resetFilters()
    {
        $this->selectedJob = '';
        $this->searchName = '';
        $this->resetPage();
    }

    public function render()
    {
        $civilians = Civilian::query()
            ->when($this->selectedJob, function ($query) {
                $query->whereHas('civilian_jobs', fn($q) => $q->where('civilian_jobs.id', $this->selectedJob));
            })
            ->when($this->searchName, function ($query) {
                $query->where('full_name', 'like', '%'.$this->searchName.'%');
            })
            ->with('civilian_jobs')
            ->paginate(10);

        return view('livewire.pekerjaan-view', [
            'civilians' => $civilians,
        ]);
    }
}