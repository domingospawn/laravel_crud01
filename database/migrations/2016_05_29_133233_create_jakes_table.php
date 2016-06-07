<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jokes', function(Blueprint $table){
            $table->increments('id');
            $table->text('body');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            //foreign key
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('jokes', function(Blueprint $table){
            $table->dropForeign(['user_id']);
        });
    }
}
