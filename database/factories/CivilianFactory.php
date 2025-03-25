<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Civilian>
 */
class CivilianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'gender' => (bool)random_int(0, 1),
            'born_place' => fake()->word(),
            'born_date' => fake()->dateTime(),
            'nik' => mt_rand(),
            'home_address' => "Jl. " . fake()->word(),
            'married_status' => (bool)random_int(0, 1),
            'phone_number' => "08" . mt_rand(),
        ];
    }
}
