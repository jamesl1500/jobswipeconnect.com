<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            $table->string("name");
            $table->string("website")->nullable();
            $table->string("logo")->nullable();
            $table->string("phone")->nullable();
            $table->string("email")->nullable();
            $table->string("address")->nullable();
            $table->string("city")->nullable();
            $table->string("state")->nullable();
            $table->string("zip")->nullable();
            $table->string("country")->nullable();
            $table->text("description")->nullable();
            $table->enum("schedule_type", ["remote", "hybrid", "on-site"]);
            $table->string("industry")->nullable();
            $table->enum("size",["1-10","11-50","51-200","201-500","501-1000","1001-5000","5001-10000","10001+"])->default("1-10");
            $table->integer("founded")->default("2024");
            $table->enum("type",["public","private","government","non-profit","other"])->default("other");
            $table->enum("revenue",["0-1M","1-10M","10-50M","50-100M","100-500M","500-1B","1-10B","10B+"])->default("0-1M");
            $table->enum("ownership",["sole-proprietorship","partnership","corporation","non-profit","other"])->default("sole-proprietorship");
            
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
        Schema::dropIfExists('companies');
    }
}
