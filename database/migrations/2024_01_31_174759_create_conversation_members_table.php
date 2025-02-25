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
            $table->string('conversation_member_uid');
            $table->foreignId("conversation_id");
            $table->foreignId("user_uid");

            $table->enum("type",["job_poster","applicant"])->default("applicant");
            $table->enum('user_role', ['admin', 'member', 'banned']);
            
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
