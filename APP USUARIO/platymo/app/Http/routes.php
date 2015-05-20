<?php

/*
|--------------------------------------------------------------------------
| Rutas
|--------------------------------------------------------------------------
*/

Route::get('/', 'WelcomeController@index');


/*
BACKEND
 */
Route::get('configuracion', 'PrincipalController@configuracion');

Route::get('configuracion/habitacion', 'HabitacionController@create');
Route::get('configuracion/habitacion/{id}', 'HabitacionController@edit');
Route::post('configuracion/habitacion/store', 'HabitacionController@store');
Route::post('configuracion/habitacion/update', 'HabitacionController@update');
Route::get('configuracion/actuador/delete/{id}/{n_id}', 'HabitacionController@borrarActuador');
Route::get('configuracion/habitacion/delete/{id}', 'HabitacionController@delete');

Route::get('configuracion/habitacion/escena/{hab_id}', 'EscenaController@create');
Route::post('configuracion/escena/store', 'EscenaController@store');
Route::get('configuracion/escena/{id}', 'EscenaController@edit');
Route::post('configuracion/escena/update', 'EscenaController@update');
Route::get('configuracion/escena/delete/{id}', 'EscenaController@delete');

Route::get('configuracion/habitacion/accion/{hab_id}', 'AccionController@create');
Route::post('configuracion/accion/store', 'AccionController@store');
Route::get('configuracion/accion/{id}', 'AccionController@edit');
Route::post('configuracion/accion/update', 'AccionController@update');
Route::get('configuracion/accion/delete/{id}', 'AccionController@delete');

/*
FRONTEND
 */
Route::get('/', 'PrincipalController@home');
Route::get('vista/{id}', 'PrincipalController@vista');
Route::get('comando/actuador/{id}/{valor}', 'ComandoController@actuador');
Route::get('comando/escena/{id}', 'ComandoController@escena');
Route::get('comando/apagar', 'ComandoController@apagarTodo');