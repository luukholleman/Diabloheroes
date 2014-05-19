<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRanklistRanksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ranklist_ranks', function(Blueprint $table){
			$table->increments('id');
			$table->integer('ranklist_id')->unsigned();
			$table->morphs('rankable');
			$table->integer('value');
			$table->integer('rank');
			$table->boolean('hardcore')->nullable();
			$table->timestamps();
		});

		Schema::table('ranklist_categories', function(Blueprint $table){
			$table->enum('type', ['career', 'hero']);
		});

		/**
		 * Foreign
		 */
		Schema::table('ranklist_ranks', function($table){
			$table->foreign('ranklist_id')->references('id')
				->on('ranklists')
				->onUpdate('cascade')
				->onDelete('cascade');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ranklist_categories', function(Blueprint $table){
			$table->dropColumn('type');
		});

		Schema::drop('ranklist_ranks');
	}

}
