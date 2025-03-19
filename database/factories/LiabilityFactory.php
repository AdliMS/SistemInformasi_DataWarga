<?php

namespace Database\Factories;

use App\Models\Civilian;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Liability>
 */
class LiabilityFactory extends Factory
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
            'gender' => fake()->word(),
            'born_date' => fake()->dateTime(),
            'last_education' => fake()->word(),
            'civilian_id' => Civilian::factory(),
        ];
    }
}
