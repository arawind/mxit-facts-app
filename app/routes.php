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

//Route::get('/', function(){ return View::make('hello'); });

Route::get('/', function(){
        return Redirect::to('/categories');
    });

// Create Categories: Passed to CategoriesController
Route::controller('categories','CategoriesController', array('getAdmin' => 'catAdmin'));

// View Categories: Passed to CategoriesController's getCategories function
Route::get('categories', array('as' => 'home', 'uses' => 'CategoriesController@gCategories'));

// Create Facts: Passed to FactsController
Route::controller('{id}/facts/admin', 'FactsController', array('getIndex' => 'factAdmin'));

// View Facts: Passed to FactsController's getFacts function
Route::get('{id}/facts', array('as' => 'facts', 'uses' => 'FactsController@gFacts'));

Route::post('{id}/facts', 'FactsController@pFacts');

Route::get('login', array('as' => 'login', function(){
        if(!Auth::check())
            return View::make('login');
        else
            return Redirect::route('home');
    }));

Route::post('signin', 'UserController@signin');

Route::post('register', 'UserController@register');

Route::get('logout', array('as' => 'logout', function(){
        Auth::logout();
        return Redirect::route('home');
    }));
