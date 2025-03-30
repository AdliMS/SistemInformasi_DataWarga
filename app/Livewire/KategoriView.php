<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Civilian;
use App\Models\Category;
use Livewire\WithPagination;

class KategoriView extends Component
{
    use WithPagination;

    public $selectedCategory = '';
    public $searchName = '';
    public $perPage = 10;
    public $appliedCategory = '';
    public $appliedSearch = '';

    public function applyFilter()
    {
        $this->appliedCategory = $this->selectedCategory;
        $this->appliedSearch = $this->searchName;
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['selectedCategory', 'searchName', 'appliedCategory', 'appliedSearch']);
        $this->resetPage();
    }

    public function render()
    {
        $civilians = Civilian::query()
            ->with('categories')
            ->when($this->appliedCategory, function ($query) {
                $query->whereHas('categories', function ($q) {
                    $q->where('categories.id', $this->appliedCategory);
                });
            })
            ->when($this->appliedSearch, function ($query) {
                $query->where('full_name', 'like', '%'.$this->appliedSearch.'%');
            })
            ->paginate($this->perPage);

        return view('livewire.kategori-view', [
            'civilians' => $civilians,
            'categories' => Category::all()
        ]);
    }
}