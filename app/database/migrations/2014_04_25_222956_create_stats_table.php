<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('stats', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
            $table->timestamps();
        });

        Schema::create('hero_stats', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('stat_id')->unsigned();
            $table->integer('hero_id')->unsigned();
            $table->float('value');
            $table->timestamps();
        });

        Schema::table('hero_stats', function($table){
            $table->foreign('stat_id')->references('id')
                ->on('stats')
	            ->onUpdate('cascade')
	            ->onDelete('cascade');
            $table->foreign('hero_id')->references('id')
                ->on('heroes')
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
        Schema::drop('hero_stats');
		Schema::drop('stats');
	}

}
