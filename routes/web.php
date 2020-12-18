<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Empleados1;
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
    return view('inicio');
});
Route::post('/registro-process','App\Http\Controllers\Empleados1@registroProcess');
Route::post('/editar-process','App\Http\Controllers\Empleados1@modificarProcess');

Route::get('/delete-process/{id}','App\Http\Controllers\Empleados1@deleteProcess');
Route::get('/listar','App\Http\Controllers\Empleados1@listar');
Route::get('/editar/{id}','App\Http\Controllers\Empleados1@editar');

