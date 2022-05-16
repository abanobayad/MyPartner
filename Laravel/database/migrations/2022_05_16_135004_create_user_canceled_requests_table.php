<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCanceledRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_canceled_requests', function (Blueprint $table) {
            $table->primary(['requester_id']);
            $table->foreignId('requester_id')->constrained('users')->onDelete('cascade');
            $table->integer('req_count')->default(1);
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
        Schema::dropIfExists('user_canceled_requests');
    }
}
