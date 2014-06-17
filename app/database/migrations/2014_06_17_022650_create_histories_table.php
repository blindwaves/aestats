<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('histories', function($table)
		{
			$table->engine = 'InnoDB';
			
			$table->increments('id');
			$table->string('batch');    // Each parsing of the HTML will be assign the same batch number.
			$table->string('category'); // The type of record, eg. player's level, economy, etc...
			$table->string('name');     // Guild/player name.
			$table->string('rank');     // Server rank.
			$table->string('server');   // Server name.
			$table->string('tag');      // Guild tag.
			$table->string('value');    // The resulting value that was parsed.
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
		Schema::drop('histories');
	}

}
