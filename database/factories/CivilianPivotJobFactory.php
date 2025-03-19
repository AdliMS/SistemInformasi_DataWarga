<?php

namespace Database\Factories;

use App\Models\Civilian;
use App\Models\CivilianJob;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CivilianPivotJob>
 */
class CivilianPivotJobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'civilian_id' => Civilian::factory(),
            'civilian_job_id' => CivilianJob::factory(),
            'accepted_date' => fake()->dateTime(),
            'retirement_date' => fake()->dateTime(),
        ];
    }
}
