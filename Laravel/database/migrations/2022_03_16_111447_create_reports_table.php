<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {



            $table->primary(['post_id', 'user_id']);
            $table->foreignId('user_id')->constrained('users','id');
            $table->foreignId('post_id')->constrained('posts','id')->onDelete('cascade');


            $table->enum('reason' , ['reason1' , 'reason2' , 'reason3' , 'reason4']);
            $table->text('feedback');

            $table->enum('is_handled' , ['yes' , 'no'])->default('no');


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
        Schema::dropIfExists('reports');
    }
}
