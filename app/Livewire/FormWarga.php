<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Civilian;
use App\Models\CivilianJob;
use App\Models\CivilianPivotJob;
use Illuminate\Support\Facades\DB;

class FormWarga extends Component
{
    public $full_name;
    public $gender;
    public $born_place;
    public $born_date;
    public $nik;
    public $married_status;
    public $home_address;
    public $phone_number;
    public $categoryId;
    public $jobOptions = [];

    public function mount($category_id = null)
    {
        if ($category_id !== null) {
            $this->categoryId = $category_id;
        }

        $this->jobOptions = CivilianJob::pluck('job_place', 'id')->toArray();
    }


    public $pekerjaan = [
        ['civilian_job_id' => '', 'accepted_date' => '', 'retirement_date' => '']
    ];

    public function addPekerjaan()
    {
        $this->pekerjaan[] = ['civilian_job_id' => '', 'accepted_date' => '', 'retirement_date' => ''];
    }
    
    public function removePekerjaan($index)
    {
        unset($this->pekerjaan[$index]);
        $this->pekerjaan = array_values($this->pekerjaan); // reset indeks
    }
    
    public $tanggungan = [
        ['full_name' => '', 'born_date' => '', 'gender' => '', 'last_education' => '']
    ];

    public function addTanggungan()
    {
        $this->tanggungan[] = ['full_name' => '', 'born_date' => '', 'gender' => '', 'last_education' => ''];
    }

    public function removeTanggungan($index)
    {
        unset($this->tanggungan[$index]);
        $this->tanggungan = array_values($this->tanggungan); // reset indeks agar rapi
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'full_name' => 'required|string|min:5',
            'gender' => 'required|string',
            'born_place' => 'required|string',
            'born_date' => 'required|date',
            'nik' => 'required|string|min:16|max:16',
            'married_status' => 'required|string',
            'home_address' => 'required|string',
            'phone_number' => 'required|string|max:20',
            'tanggungan.*.full_name' => 'required|string',
            'tanggungan.*.born_date' => 'required|date',
            'tanggungan.*.gender' => 'required|string',
            'tanggungan.*.last_education' => 'required|string',
            'pekerjaan.*.civilian_job_id' => 'required|string',
            'pekerjaan.*.accepted_date' => 'required|string',
            'pekerjaan.*.retirement_date' => 'required|string',
        ]);
    }

    public function submit()
    {
        $this->validate([
            'full_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'born_place' => 'required|string',
            'born_date' => 'required|date',
            'nik' => 'required|string|min:16|max:16',
            'married_status' => 'required|string',
            'home_address' => 'required|string',
            'phone_number' => 'required|string|max:20',
            'tanggungan.*.full_name' => 'required|string',
            'tanggungan.*.born_date' => 'required|date',
            'tanggungan.*.gender' => 'required|string',
            'tanggungan.*.last_education' => 'required|string',
            'pekerjaan.*.civilian_job_id' => 'required|string',
            'pekerjaan.*.accepted_date' => 'required|string',
            'pekerjaan.*.retirement_date' => 'required|string',
        ]);

        $this->married_status = $this->married_status === 'Menikah' ? 1 : 0;
        $this->gender = $this->gender === 'Wanita' ? 1 : 0;
        foreach ($this->tanggungan as $index => $item) {
            $this->tanggungan[$index]['gender'] = $item['gender'] === 'Wanita' ? 1 : 0;
        }
        

        // dd([
        //     'full_name' => $this->full_name,
        //     'gender' => $this->gender,
        //     'born_place' => $this->born_place,
        //     'born_date' => $this->born_date,
        //     'nik' => $this->nik,
        //     'married_status' => $this->married_status,
        //     'home_address' => $this->home_address,
        //     'phone_number' => $this->phone_number,
        //     'category_id' => $this->categoryId,
        //     'tanggungan' => $this->tanggungan,
        //     'pekerjaan' => $this->pekerjaan,
        // ]);


        DB::transaction(function () {
            $civilian = Civilian::create([
                'full_name' => $this->full_name,
                'gender' => $this->gender,
                'born_place' => $this->born_place,
                'born_date' => $this->born_date,
                'nik' => $this->nik,
                'married_status' => $this->married_status,
                'home_address' => $this->home_address,
                'phone_number' => $this->phone_number,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Simpan kategori
            DB::table('civilian_pivot_categories')->insert([
                'civilian_id' => $civilian->id,
                'category_id' => $this->categoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Simpan tanggungan
            foreach ($this->tanggungan as $item) {
                $civilian->liabilities()->create([
                    'full_name' => $item['full_name'],
                    'born_date' => $item['born_date'],
                    'gender' => $item['gender'],
                    'last_education' => $item['last_education'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Simpan pekerjaan
            foreach ($this->pekerjaan as $item) {
                if ($item['civilian_job_id']) {
                    CivilianPivotJob::create([
                        'civilian_id' => $civilian->id,
                        'civilian_job_id' => $item['civilian_job_id'],
                        'accepted_date' => $item['accepted_date'] ?? '',
                        'retirement_date' => $item['retirement_date'] ?? '',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        });

        $catId = $this->categoryId; // simpan dulu
        
        $this->reset();
        
        $this->categoryId = $catId; // restore ulang
        $this->jobOptions = CivilianJob::pluck('job_place', 'id')->toArray();
        $this->dispatch('show-success-alert', [
            'message' => 'Data warga berhasil ditambahkan!'
        ]);

    }


    public function render()
    {
        return view('livewire.form-warga', [
            'categoryId' => $this->categoryId,
        ]);
    }
}
