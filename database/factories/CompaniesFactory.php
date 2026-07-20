<?php

namespace Database\Factories;

use App\Models\Companies;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Companies>
 */
class CompaniesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'website' => $this->faker->url(),
            'logo' => null,
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->companyEmail(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(),
            'zip' => $this->faker->postcode(),
            'country' => 'United States',
            'description' => $this->faker->catchPhrase() . '. ' . $this->faker->paragraph(3),
            'schedule_type' => $this->faker->randomElement(['remote', 'hybrid', 'on-site']),
            'industry' => $this->faker->randomElement(['Technology', 'Healthcare', 'Finance', 'Retail', 'Manufacturing', 'Education']),
            'size' => $this->faker->randomElement(['1-10', '11-50', '51-200', '201-500']),
            'founded' => $this->faker->numberBetween(1990, 2024),
            'type' => $this->faker->randomElement(['public', 'private', 'non-profit']),
            'revenue' => $this->faker->randomElement(['0-1M', '1-10M', '10-50M']),
            'ownership' => $this->faker->randomElement(['sole-proprietorship', 'partnership', 'corporation']),
        ];
    }
}
