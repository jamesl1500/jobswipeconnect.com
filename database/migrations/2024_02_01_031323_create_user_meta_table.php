<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_meta', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();

            // Put socials here
            $table->text("facebook")->nullable();
            $table->text("twitter")->nullable();
            $table->text("linkedin")->nullable();
            $table->text("instagram")->nullable();
            $table->text("github")->nullable();

            // Put other user meta here
            $table->text("bio")->nullable();
            

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
        Schema::dropIfExists('user_meta');
    }
}
