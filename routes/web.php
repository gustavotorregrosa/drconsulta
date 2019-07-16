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
    // return view('welcome');
    return redirect('/medicos');
});

Auth::routes();



Route::get('/medicos', 'MedicoController@index');

Auth::routes();

Route::get('/home', function(){
    return redirect('/medicos');
});

Route::get('/logout', 'Auth\LoginController@logout');

Route::post('/medico/salvar', 'MedicoController@salvar');

Route::get('/medico/listar', 'MedicoController@listar');

Route::delete('/medico/deletar/{id}', 'MedicoController@destroy');

