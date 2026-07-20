<?php

namespace Database\Factories;

use App\Models\Experiences;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Experiences>
 */
class ExperiencesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-8 years', '-1 years');
        $isCurrent = $this->faker->boolean(30);

        return [
            'title' => $this->faker->jobTitle(),
            'company' => $this->faker->company(),
            'start_date' => $start,
            'end_date' => $isCurrent ? null : $this->faker->dateTimeBetween($start, 'now'),
            'description' => $this->faker->paragraph(2),
            'is_current_job' => $isCurrent,
            'employment_type' => $this->faker->randomElement(['full-time', 'part-time', 'internship', 'freelance', 'contract', 'temporary', 'remote', 'other']),
            'position' => 0,
        ];
    }
}
