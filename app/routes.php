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

Route::get('/', function()
{
	return View::make('hello');
});

// Create Categories: Passed to CategoriesController
Route::controller('create-categories','CategoriesController');

// View Categories: Passed to CategoriesController's getCategories function
Route::get('categories','CategoriesController@getCategories');

// Create Facts: Passed to FactsController
Route::controller('{id}/create-facts', 'FactsController');

// View Facts: Passed to FactsController's getFacts function
Route::get('{id}/facts', 'FactsController@getFacts');

Route::post('{id}/facts', 'FactsController@postFacts');
