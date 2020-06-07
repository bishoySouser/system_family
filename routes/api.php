<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

// Individual
Route::resource('individual', 'Api\Individuals')->middleware('jwt.auth');
Route::patch('individual/delete/multiple', 'Api\Individuals@destroyAll');
Route::get('individual/unmarried/{name}/{gander?}', 'Api\Individuals@unmarried');
Route::post('individual/import/excel', 'Api\Individuals@importExcel');

// Family
Route::apiResource('family', 'Api\families')->middleware('jwt.auth');;
Route::patch('family/delete/multiple', 'Api\families@destroyAll');

// excel

// //family
// Route::post('family/add','Api\FamilyController@addFamily');
// Route::get('family/one/{id}','Api\FamilyController@getFamily');
// Route::get('family/all','Api\FamilyController@getFamilies');
// Route::put('family/edit/{id}','Api\FamilyController@editFamily');
// Route::delete('family/delete/{id}','Api\FamilyController@deleteFamily');

//search
Route::get('search/individual/{search}','Api\SearchController@individualName');
Route::get('search/individual/young/{grander}/{search}','Api\SearchController@getYoung');
