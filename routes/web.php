<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/register', 'Auth\\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\\RegisterController@register');
Route::get('/login', 'Auth\\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\\LoginController@login');
Route::post('/logout', 'Auth\\LoginController@logout')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/bloque', 'BloqueController@index');
    Route::post('/bloque/crear', 'BloqueController@store');
    Route::get('/bloque/{id}', 'BloqueController@show')->where('id', '[0-9]+');
    Route::delete('/bloque/{id}/eliminar', 'BloqueController@destroy')->where('id', '[0-9]+');

    Route::get('/plan', 'PlanController@index');
    Route::post('/plan/crear', 'PlanController@store');
    Route::put('/plan/{id}', 'PlanController@update')->where('id', '[0-9]+');
    Route::delete('/plan/{id}', 'PlanController@destroy')->where('id', '[0-9]+');

    Route::get('/sesion', 'SesionController@index');
    Route::post('/sesion/crear', 'SesionController@store');
    Route::get('/sesion/{id}', 'SesionController@show')->where('id', '[0-9]+');
    Route::delete('/sesion/{id}', 'SesionController@destroy')->where('id', '[0-9]+');

    Route::post('/resultado/crear', 'ResultadoController@store');
    Route::get('/resultado/{id}', 'ResultadoController@show')->where('id', '[0-9]+');

    Route::get('/sesionbloque', 'SesionBloqueController@index');
    Route::post('/sesionbloque/crear', 'SesionBloqueController@store');
    Route::get('/sesionbloque/{id}/editar', 'SesionBloqueController@edit')->where('id', '[0-9]+');
    Route::put('/sesionbloque/{id}', 'SesionBloqueController@update')->where('id', '[0-9]+');
    Route::delete('/sesionbloque/{id}', 'SesionBloqueController@destroy')->where('id', '[0-9]+');

    Route::get('/', 'HomeController@index')->name('root');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/consulta/{key}', 'HomeController@consulta')->name('consulta');
});
