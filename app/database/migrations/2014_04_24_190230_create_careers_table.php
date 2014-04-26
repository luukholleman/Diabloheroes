<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCareersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('careers', function(Blueprint $table) {
			$table->increments('id');
            $table->string('battletag', 25);
			$table->timestamps();
		});

        Schema::create('career_regions', function(Blueprint $table){
            $table->increments('id');
            $table->integer('career_id')->unsigned();
            $table->string('region', 2);
            $table->integer('monsters_killed');
            $table->integer('hardcore_monsters_killed');
            $table->integer('elites_killed');
            $table->string('time_played');
            $table->smallInteger('paragon_level');
            $table->smallInteger('hardcore_paragon_level');
            $table->integer('last_played_hero');
            $table->timestamps();
        });

        /**
         * Foreign keys
         */
        Schema::table('career_regions', function($table){
            $table->foreign('career_id')->references('id')
                ->on('careers');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('career_regions');
		Schema::drop('careers');
	}

}
