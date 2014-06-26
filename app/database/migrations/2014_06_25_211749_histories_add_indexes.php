<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HistoriesAddIndexes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('histories', function($t) {
			$t->index('category');
			$t->index('url');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('histories', function($t) {
			$t->dropIndex('histories_category_index');
			$t->dropIndex('histories_url_index');
		});
	}

}
