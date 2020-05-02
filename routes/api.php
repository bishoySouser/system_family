<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
// individual
Route::post('individual/add', 'Api\IndividualController@insertIndividual'); //add persone information
Route::get('individual/one/{id}','Api\IndividualController@getIndividual'); //select one persone
Route::get('individual/all','Api\IndividualController@getIndividuals'); //select all persone
Route::put('individual/edit/{id}','Api\IndividualController@editIndividual'); //edit persone information
Route::delete('individual/delete/{id}', 'Api\IndividualController@deleteIndividual'); //delete persone
// excel
Route::post('individual/excel/import', 'Api\ExcelController@importIndividuals');

//family
Route::post('family/add','Api\FamilyController@addFamily');
Route::get('family/one/{id}','Api\FamilyController@getFamily');
Route::get('family/all','Api\FamilyController@getFamilies');
Route::put('family/edit/{id}','Api\FamilyController@editFamily');
Route::delete('family/delete/{id}','Api\FamilyController@deleteFamily');

//search
Route::get('search/individual/{search}','Api\SearchController@individualName');
Route::get('search/individual/young/{grander}/{search}','Api\SearchController@getYoung');
