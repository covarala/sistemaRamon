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

Route::get('', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('inicial', 'MainController@inicial');
Route::get('/login', 'MainController@login');
Route::get('/register', 'MainController@register');
Route::post('inicial', 'LoginController@login')->name('formulario.login');
Route::get('logout', 'LoginController@logout')->name('botao.logout');
