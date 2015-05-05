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

/*
FRONTEND
 */
Route::get('/', 'PrincipalController@home');
Route::get('comando/actuador/{id}/{valor}', 'ComandoController@actuador');