<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum("role",["job-seeker","job-poster"])->default("job-seeker");

            // Onboarding
            $table->string("address")->nullable();
            $table->string("city")->nullable();
            $table->string("state")->nullable();
            $table->string("zip")->nullable();
            $table->string("country")->nullable();

            $table->string("phone")->nullable();

            $table->string("profile_picture")->nullable();

            $table->string("resume")->nullable();
            $table->string("cover_letter")->nullable();
            $table->string("skills")->nullable();

            $table->string("linkedin")->nullable();
            $table->string("github")->nullable();
            $table->string("portfolio")->nullable();
            $table->string("twitter")->nullable();
            $table->string("facebook")->nullable();
            $table->string("instagram")->nullable();

            // Onboarding steps
            $table->boolean("onboarding_step_1")->default(false);
            $table->boolean("onboarding_step_2")->default(false);

            $table->rememberToken();
            $table->timestamps();

            /**
             * MAny to many relationships between users and conversations topic!
             */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
