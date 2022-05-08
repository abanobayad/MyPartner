<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('body');
            $table->string('attachment')->nullable();
            $table->foreignId('sender_id')->constrained('users','id');
            $table->foreignId('chat_id')->constrained('chats','id');
            $table->enum('v_user1',[1,0])->default(1); //1 means visable
            $table->enum('v_user2',[1,0])->default(1); //1 means visable
            $table->integer('seen')->default(0);
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
        Schema::dropIfExists('messages');
    }
}
