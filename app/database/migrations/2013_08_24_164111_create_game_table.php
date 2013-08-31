<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('games', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('name'); // Name of the game, optional
			$table->text('word'); // New line separated words
			$table->integer('duration'); // game duration for each word in seconds
			$table->integer('interval_dutraion'); // game interval for each word duration for each word in seconds
			$table->string('players');
			$table->integer('minimum_letter');
			$table->text('status');
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
		Schema::drop('games');
	}

}
