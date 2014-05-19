<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHeroesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('heroes', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('career_region_id')->unsigned();
            $table->integer('blizzard_id');
            $table->string('region', 2);
            $table->string('name', 25);
            $table->boolean('gender');
            $table->string('klass', 15);
            $table->smallInteger('level');
            $table->boolean('hardcore');
            $table->boolean('dead');
            $table->timestamp('last_played');
			$table->timestamps();
		});

        Schema::table('heroes', function($table){
            $table->foreign('career_region_id')->references('id')
                ->on('career_regions')
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
		Schema::drop('heroes');
	}

}
