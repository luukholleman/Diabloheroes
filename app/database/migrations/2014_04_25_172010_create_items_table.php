<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /**
         * Create tables
         */
        Schema::create('items', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('hero_id')->unsigned()->nullable();
            $table->string('blizzard_id', 20);
            $table->string('name', 50);
            $table->string('slot', 20);
            $table->string('icon', 50);
            $table->string('tooltip_params');
            $table->smallInteger('required_level');
            $table->smallInteger('item_level');
            $table->smallInteger('bonus_affixes');
            $table->smallInteger('bonus_affixes_max');
            $table->boolean('account_bound');
            $table->string('type_name', 20);
            $table->boolean('two_handed');
            $table->string('type_id', 20);
            $table->smallInteger('armor');
            $table->smallInteger('armor_max');
			$table->timestamps();
		});

        Schema::create('item_attributes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
        });

        Schema::create('item_attribute_raw', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->integer('item_attribute_id')->unsigned();
            $table->float('min');
            $table->float('max');
        });

        /**
         * Foreign keys
         */
        Schema::table('items', function($table){
            $table->foreign('hero_id')->references('id')
                ->on('heroes')
                ->onUpdate('cascade')
	            ->onDelete('set null');
        });

        Schema::table('item_attribute_raw', function($table){
            $table->foreign('item_id')->references('id')
                ->on('items')
	            ->onUpdate('cascade')
	            ->onDelete('cascade');
            $table->foreign('item_attribute_id')->references('id')
                ->on('item_attributes')
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
        Schema::drop('item_attribute_raw');
        Schema::drop('item_attributes');
		Schema::drop('items');
	}

}
