<?php

use Illuminate\Database\Migrations\Migration;

class CreateRatingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('Ratings', function($t){
            $t->increments('id');
            $t->integer('factID')->unsigned();
            $t->foreign('factID')->references('id')->on('Facts');
            $t->smallInteger('rating');
            $t->string('userID', 25);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
        Schema::dropIfExists('Ratings');
	}

}
