<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            $table->string("school");
            $table->string("degree");
            $table->string("field_of_study");
            $table->date("start_date");
            $table->date("end_date")->nullable();
            $table->text("description")->nullable();
            $table->boolean("is_current_study")->default(false);
            $table->enum("education_level",["high-school","diploma","certificate","associate","bachelor","master","doctorate","other"])->default("bachelor");
            $table->enum("grade",["A","B","C","D","E","F"])->nullable();
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
        Schema::dropIfExists('education');
    }
}
