<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPosterMatchLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_poster_match_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("job_poster_id")->constrained("users")->onDelete("cascade");
            $table->foreignId("job_id")->constrained()->onDelete("cascade");
            $table->foreignId("job_seeker_id")->constrained("users")->onDelete("cascade");
            $table->enum("type", ["like", "dislike"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_poster_match_likes');
    }
}
