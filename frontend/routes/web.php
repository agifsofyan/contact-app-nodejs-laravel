<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => '/'], function(){
	Route::post('/', 'ContactController@store')->name('contact.store');
	Route::get('/', 'ContactController@index')->name('contact.index');
	Route::get('/{id}', 'ContactController@show')->name('contact.show');
	Route::put('/{id}', 'ContactController@update')->name('contact.update');
	Route::delete('/{id}', 'ContactController@delete')->name('contact.delete');
	Route::delete('/', 'ContactController@drop')->name('contact.drop');
});
