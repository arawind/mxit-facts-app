<?php

use Illuminate\Database\Migrations\Migration;

class CreateTablesAllNew extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('Ratings', function($t){
            $t->increments('id');
            $t->integer('factID')->unsigned();
            $t->smallInteger('rating');
            $t->string('userID', 25);
        });
		//
		Schema::create('Facts', function($t){
            $t->increments('id');
            $t->integer('catID')->unsigned();
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
	}

}
