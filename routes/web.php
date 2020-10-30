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

/*Route::get('/', function () {
    return view('front_map');
});*/
Route::get('/map', function () {
    return view('front_map');
});

Route::get('/dash', function () {
    return view('dash_map');
});

/*Route::get('/routes_map', function () {
    return view('routes_map');
});*/


//Route::resource('arret_bus', 'ArretController@index');

Route::resource('ligne', 'ligneController');
Route::resource('arret_bus', 'ArretController');
Route::resource('routes', 'arretligneController');
//Route::get('/phpfirebase_sdk','FirebaseController@index');