<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'job-seeker',
            'onboarding_step_1' => true,
            'onboarding_step_2' => true,
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(),
            'zip' => $this->faker->postcode(),
            'country' => 'United States',
            'profile_picture' => null,
            'resume' => null,
            'cover_letter' => $this->faker->paragraph(3),
            'skills' => implode(', ', $this->faker->words(6)),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user is a job seeker who has completed onboarding.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function jobSeeker()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'job-seeker',
                'onboarding_step_1' => true,
                'onboarding_step_2' => true,
            ];
        });
    }

    /**
     * Indicate that the user is a job poster who has completed onboarding.
     *
     * Job posters skip onboarding step 2 entirely (it's job-seeker-only, see
     * OnboardingController::showStep2 and OnboardingMiddleware).
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function jobPoster()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'job-poster',
                'onboarding_step_1' => true,
                'onboarding_step_2' => false,
            ];
        });
    }
}
