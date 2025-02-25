<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversation_messages', function (Blueprint $table) {
            $table->id();
            $table->string('conversation_message_uid');
            $table->unsignedBigInteger('conversation_uid');
            $table->unsignedBigInteger('user_uid');
            $table->string('conversation_message_content');
            $table->string('conversation_message_type');
            $table->enum("status",["sent","delivered","read"])->default("sent");
            $table->text("attachment")->nullable();
            $table->text("attachment_type")->nullable();
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
        Schema::dropIfExists('conversation_messages');
    }
}
