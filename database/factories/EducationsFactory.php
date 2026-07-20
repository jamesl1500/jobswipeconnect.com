<?php

namespace Database\Factories;

use App\Models\Educations;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Educations>
 */
class EducationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-10 years', '-4 years');
        $isCurrent = $this->faker->boolean(15);

        return [
            'school' => $this->faker->company() . ' University',
            'degree' => $this->faker->randomElement(['B.S. Computer Science', 'B.A. Business', 'M.S. Data Science', 'A.A. General Studies', 'Ph.D. Psychology']),
            'field_of_study' => $this->faker->randomElement(['Computer Science', 'Business Administration', 'Marketing', 'Engineering', 'Design']),
            'start_date' => $start,
            'end_date' => $isCurrent ? null : $this->faker->dateTimeBetween($start, 'now'),
            'description' => $this->faker->optional(0.5)->sentence(),
            'is_current_study' => $isCurrent,
            'education_level' => $this->faker->randomElement(['high-school', 'diploma', 'certificate', 'associate', 'bachelor', 'master', 'doctorate', 'other']),
            'grade' => $this->faker->optional(0.6)->randomElement(['A', 'B', 'C', 'D']),
            'position' => 0,
        ];
    }
}
