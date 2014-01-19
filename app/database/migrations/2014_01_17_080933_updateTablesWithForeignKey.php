<?php

use Illuminate\Database\Migrations\Migration;

class UpdateTablesWithForeignKey extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::table('Facts', function($table){
            $table->foreign('catID')->references('id')->on('Categories');
        });
        Schema::table('Ratings', function($table){
            $table->foreign('factID')->references('id')->on('Facts');
        });	}

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
