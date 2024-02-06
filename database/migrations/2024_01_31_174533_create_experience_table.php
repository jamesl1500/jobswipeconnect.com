<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            $table->string("title");
            $table->string("company");
            $table->date("start_date");
            $table->date("end_date")->nullable();
            $table->text("description")->nullable();
            $table->boolean("is_current_job")->default(false);
            $table->enum("employment_type",["full-time","part-time","internship","freelance","contract","temporary","remote","other"])->default("full-time");
            
            // Position in the list
            $table->integer("position")->default(0);

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
        Schema::dropIfExists('experience');
    }
}
