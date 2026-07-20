<?php

namespace Database\Seeders;

use App\Models\Companies;
use App\Models\Educations;
use App\Models\Experiences;
use App\Models\Jobs;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 5 job-poster users, each owning 1 company with 2-3 jobs
        User::factory()
            ->count(5)
            ->jobPoster()
            ->create()
            ->each(function (User $poster) {
                $company = $poster->companies()->create(Companies::factory()->raw());

                Jobs::factory()
                    ->count(rand(2, 3))
                    ->create([
                        'user_id' => $poster->id,
                        'company_id' => $company->id,
                    ]);
            });

        // 15 job-seeker users, each with experiences/educations
        User::factory()
            ->count(15)
            ->jobSeeker()
            ->create()
            ->each(function (User $seeker) {
                Experiences::factory()
                    ->count(rand(1, 3))
                    ->sequence(fn ($sequence) => ['position' => $sequence->index])
                    ->create(['user_id' => $seeker->id]);

                Educations::factory()
                    ->count(rand(1, 2))
                    ->sequence(fn ($sequence) => ['position' => $sequence->index])
                    ->create(['user_id' => $seeker->id]);
            });
    }
}
