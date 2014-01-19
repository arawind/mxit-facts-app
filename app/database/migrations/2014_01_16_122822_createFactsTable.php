<?php

use Illuminate\Database\Migrations\Migration;

class CreateFactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
	        Schema::create('Facts', function($t){
            $t->increments('id');
            $t->integer('catID')->unsigned();
            $t->foreign('catID')->references('id')->on('Categories');
            $t->text('fact');
            $t->string('userID', 25);
            $t->boolean('approved');
            $t->timestamp('time');
            $t->boolean('factOfDay');
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
        Schema::dropIfExists('Facts');
	}

}
