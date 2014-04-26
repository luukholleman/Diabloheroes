<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSkillsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('skill_active_categories', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('skill_actives', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('skill_active_category_id')->unsigned();
            $table->string('slug', 50);
            $table->string('name', 50);
            $table->string('icon', 50);
            $table->integer('level');
            $table->string('tooltip_url', 50);
            $table->text('description');
            $table->text('simple_description');
            $table->string('skill_calc_id', 2);
            $table->timestamps();
        });

        Schema::create('runes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('type', 50);
            $table->string('slug', 50);
            $table->string('name', 50);
            $table->integer('level');
            $table->string('tooltip_url', 50);
            $table->text('description');
            $table->text('simple_description');
            $table->string('skill_calc_id', 2);
            $table->smallInteger('order');
            $table->timestamps();
        });

        Schema::create('skill_passives', function(Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 50);
            $table->string('name', 50);
            $table->string('icon', 50);
            $table->integer('level');
            $table->string('tooltip_url', 50);
            $table->text('description');
            $table->text('flavor');
            $table->string('skill_calc_id', 2);
            $table->timestamps();
        });

        Schema::create('hero_skill_actives', function(Blueprint $table){
            $table->increments('id');
            $table->integer('skill_active_id')->unsigned();
            $table->integer('hero_id')->unsigned();
            $table->integer('rune_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('hero_skill_passives', function(Blueprint $table){
            $table->increments('id');
            $table->integer('skill_passive_id')->unsigned();
            $table->integer('hero_id')->unsigned();
            $table->timestamps();
        });

        /**
         * Foreign
         */
        Schema::table('skill_actives', function($table){
            $table->foreign('skill_active_category_id')->references('id')
                ->on('skill_active_categories');
        });

        Schema::table('hero_skill_actives', function($table){
            $table->foreign('skill_active_id')->references('id')
                ->on('skill_actives');
            $table->foreign('hero_id')->references('id')
                ->on('heroes');
            $table->foreign('rune_id')->references('id')
                ->on('runes');
        });

        Schema::table('hero_skill_passives', function($table){
            $table->foreign('skill_passive_id')->references('id')
                ->on('skill_passives');
            $table->foreign('hero_id')->references('id')
                ->on('heroes');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hero_skill_passives');
		Schema::drop('hero_skill_actives');
		Schema::drop('skill_passives');
		Schema::drop('skill_actives');
		Schema::drop('runes');
		Schema::drop('skill_active_categories');
	}

}
