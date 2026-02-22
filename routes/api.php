<?php

use Illuminate\Support\Facades\Route;

Route::get('/sesiones/{id}/resultados', 'Api\\ResultadoApiController@bySesion')->where('id', '[0-9]+');

Route::apiResource('bloques', 'Api\\BloqueApiController');
Route::apiResource('planes', 'Api\\PlanApiController');
Route::apiResource('sesiones', 'Api\\SesionApiController');
Route::apiResource('sesion-bloques', 'Api\\SesionBloqueApiController');
Route::apiResource('resultados', 'Api\\ResultadoApiController');

Route::get('/catalogos/bicicletas', 'Api\\CatalogoApiController@bicicletas');
Route::get('/catalogos/ciclistas', 'Api\\CatalogoApiController@ciclistas');
Route::get('/catalogos/planes', 'Api\\CatalogoApiController@planes');
