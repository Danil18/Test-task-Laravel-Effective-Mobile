<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/tasks', 'App\Http\Controllers\TasksController@index');

Route::get('/tasks/{task}', 'App\Http\Controllers\TasksController@show');

Route::post('/tasks', 'App\Http\Controllers\TasksController@store');

Route::put('/tasks/{task}', 'App\Http\Controllers\TasksController@update');

Route::delete('/tasks/{task}', 'App\Http\Controllers\TasksController@destroy');
