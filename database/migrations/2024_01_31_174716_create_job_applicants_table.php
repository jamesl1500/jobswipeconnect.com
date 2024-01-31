<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applicants', function (Blueprint $table) {
            $table->id();
            $table->foreignId("job_id")->constrained();
            $table->foreignId("user_id")->constrained();
            $table->enum("status",["applied","interviewing","shortlisted","rejected","hired"])->default("applied");
            $table->text("cover_letter")->nullable();
            $table->text("resume")->nullable();
            $table->text("skills")->nullable();
            $table->text("notes")->nullable();
            $table->text("interview_date")->nullable();
            $table->text("interview_time")->nullable();
            $table->text("interview_location")->nullable();
            $table->text("interview_notes")->nullable();
            $table->text("offer_date")->nullable();
            $table->text("offer_salary")->nullable();
            $table->text("offer_notes")->nullable();
            $table->text("hired_date")->nullable();
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
        Schema::dropIfExists('job_applicants');
    }
}
