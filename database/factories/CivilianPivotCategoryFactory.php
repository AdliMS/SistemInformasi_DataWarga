<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Civilian;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CivilianPivotCategory>
 */
class CivilianPivotCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_place' => fake()->word(),
            'civilian_id' => Civilian::factory(),
            'category_id' => Category::factory(),
            'accepted_date' => fake()->dateTime(),
            'retirement_date' => fake()->dateTime(),
        ];
    }
}
