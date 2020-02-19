<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/{any}',  function () {
    return view('home');
})->where('any', '.*');


// Route::get('/', function () {
    
//     return view('home');
// })->middleware('auth');


// Route::get('/family',function () {
    
//     return view('home');
// })->middleware('auth');

// Route::get('/individual',function () {
    
//     return view('home');
// })->middleware('auth');

// Route::get('/login', function () {
//     if (auth()->user()) {
//         return redirect('/');
//     }
//     return view('pages/login');
// })->name('login');

// Route::group(['prefix' => 'auth'] ,function () {
//     Route::get('init', 'Appcontroller@init');

//     Route::post('login', 'AppController@login');
//     Route::post('logout', 'AppController@logout');
// });

// //individual 
// Route::resource('persone', 'IndividualController');
// Route::get('persone/search','IndividualController@search')->middleware('auth');