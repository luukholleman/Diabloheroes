<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gems', function(Blueprint $table) {
			$table->increments('id');
            $table->string('blizzard_id', 20);
            $table->string('name', 30);
            $table->string('icon', 50);
            $table->string('display_color', 20);
            $table->string('tooltip_params', 100);
		});

        Schema::create('item_gems', function(Blueprint $table){
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->integer('gem_id')->unsigned();
            $table->integer('slot');
            $table->timestamps();
        });

        Schema::table('item_gems', function($table){
            $table->foreign('item_id')->references('id')
                ->on('items')
	            ->onUpdate('cascade')
	            ->onDelete('cascade');
            $table->foreign('gem_id')->references('id')
                ->on('gems')
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
        Schema::drop('item_gems');
        Schema::drop('gems');
	}

}
