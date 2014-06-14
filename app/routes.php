<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::controller('hero', 'HeroController', [
	'getProfile' => 'hero.profile',
	'getStats' => 'hero.stats',
]);

Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@showIndex'
));

Route::get('/{ranklist}/{mode?}/{region?}', array(
	'as' => 'home.ranklist',
	'uses' => '\DH\Ranklist\Controller\HomeController@showRanklist'
));
//
//Route::group(['prefix' => 'api/v1'], function(){
//	/**
//	 * Hero
//	 */
//	Route::get('heroes', [
//		'as' => 'api.v1.hero.index',
//		'uses' => 'Api\V1\HeroController@getIndex',
//	]);
//	Route::get('hero/{id}', [
//		'as' => 'api.v1.hero',
//		'uses' => 'Api\V1\HeroController@getDetail',
//	]);
//
//	/**
//	 * Ranklist
//	 */
//	Route::get('ranklists', [
//		'as' => 'api.v1.ranklist.index',
//		'uses' => 'Api\V1\RanklistController@getIndex',
//	]);
//});

//App::missing(function($exception)
//{
//	return View::make('layout');
//});

//App::error(function($e){
//    return Response::json(['error' => get_class($e), 'message' => $e->getMessage() ]);
//});