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

Route::get('/', function () {
    return redirect()->to('home');
});

Route::resource('movimientos','MovimientosControlador');

Auth::routes(); //se crea por el login verificacion

Route::get('/home', 'HomeController@index')->name('home');//Route::get('/home', 'HomeController@index')->name('home');   se crea por el login verificacion

