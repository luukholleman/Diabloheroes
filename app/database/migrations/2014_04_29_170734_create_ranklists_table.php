<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRanklistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ranklist_categories', function(Blueprint $table){
			$table->increments('id');
			$table->string('name', 30);
			$table->smallInteger('order');
		});

		Schema::create('ranklists', function(Blueprint $table){
			$table->increments('id');
			$table->integer('ranklist_category_id')->unsigned();
			$table->string('name', 30);
			$table->string('stat', 30);
		});

		Schema::table('ranklists', function(Blueprint $table){
			$table->foreign('ranklist_category_id')->references('id')->on('ranklist_categories')
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
		Schema::drop('ranklists');
		Schema::drop('ranklist_categories');
	}

}
