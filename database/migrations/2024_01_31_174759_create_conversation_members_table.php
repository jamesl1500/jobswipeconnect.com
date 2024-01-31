<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversation_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId("conversation_id")->constrained();
            $table->foreignId("user_id")->constrained();
            $table->enum("type",["job_poster","applicant"])->default("applicant");
            
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
        Schema::dropIfExists('conversation_members');
    }
}
