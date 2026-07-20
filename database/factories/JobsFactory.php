<?php

namespace Database\Factories;

use App\Models\Jobs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Jobs>
 */
class JobsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->text(200),
            'job_category' => $this->faker->randomElement(['information-technology', 'engineering', 'sales', 'marketing', 'design', 'customer-service', 'healthcare', 'finance', 'other']),
            'job_status' => $this->faker->randomElement(['full-time', 'part-time', 'contract', 'temporary', 'internship', 'other']),
            'location' => $this->faker->city() . ', ' . $this->faker->stateAbbr(),
            'employment_location_type' => $this->faker->randomElement(['remote', 'hybrid', 'On Site']),
            'benefits' => implode(', ', $this->faker->words(5)),
            'salary' => (string) $this->faker->numberBetween(40000, 150000),
            'job_salary_type' => $this->faker->randomElement(['hourly', 'salaried', 'commission', 'other']),
            'responsibilities' => $this->faker->text(200),
            'requirements' => $this->faker->text(200),
            'experience_level' => $this->faker->randomElement(['internship', 'entry-level', 'associate', 'mid-senior-level', 'director', 'executive']),
            'education_level' => $this->faker->randomElement(['high-school', 'diploma', 'certificate', 'associate', 'bachelor', 'master', 'doctorate', 'other']),
            'skills' => implode(', ', $this->faker->words(6)),
        ];
    }
}
