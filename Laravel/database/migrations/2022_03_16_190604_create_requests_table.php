<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->primary(['post_id', 'requester_id']);
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->foreignId('post_owner_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('requester_id')->constrained('users')->onDelete('cascade');
            $table->enum('status' , ['pending' , 'accept' , 'reject'])->default('pending');
            // $table->enum('canceled' , ['yes' , 'no'])->default('no');
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
        Schema::dropIfExists('requests');
    }
}
