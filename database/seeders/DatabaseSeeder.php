<?php

namespace Database\Seeders;

use COM;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Civilian;
use App\Models\Category;
use App\Models\Liability;
use App\Models\CivilianJob;
use App\Models\CivilianPivotCategory;
use App\Models\CivilianPivotJob;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Employee::create([
        //     'full_name' => fake()->name(),
        //     'born_place' => fake()->word(),
        //     'born_date' => fake()->dateTime(),
        //     'nik' => mt_rand(),
        //     'home_address' => "Jl. ". fake()->word(),
        //     'married_status' => (bool)random_int(0, 1),
        //     'phone_number' => mt_rand(),
        // ]);

        // Employee::factory(20)->recycle([
        //     EmployeeJob::factory(5),
        //     Liability::factory(15),
        //     SkillCategory::factory(7),
        // ])->create();
        // Civilian::factory(5)->create();
        // CivilianJob::factory(5)->create();
        // Liability::factory(15)->create();
        // Category::factory(7)->create();

        // Tentukan jumlah data yang ingin dibuat
        $dataCount = 3;

        // Buat data dummy untuk setiap model dan hubungkan dengan recycle()
        Civilian::factory($dataCount)
            ->recycle([
                
                CivilianPivotJob::factory($dataCount),
                CivilianPivotCategory::factory($dataCount),
                Liability::factory($dataCount),
                
            ])
            ->create();
            CivilianJob::factory($dataCount)->create();
            Category::factory($dataCount)->create();
            
    }
}
