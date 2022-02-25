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



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'App\Http\Controllers\DashBoardController@Panel')->name('dashboard');


Route::group(['middleware' => ['auth']], function () {
Route::resources([
    'planteles' => 'App\Http\Controllers\PlantelesController',
    'usuarios' => 'App\Http\Controllers\UserController',
    'areas' => 'App\Http\Controllers\AreasController',
    'ticket' => 'App\Http\Controllers\DashBoardController',
    'supervision' => 'App\Http\Controllers\SupervisionController',
]);

Route::get('/consulta/areas/{area}','App\Http\Controllers\DashBoardController@consulta_areas')->name('consulta.areas');
Route::get('/consulta/user/{usuarios}','App\Http\Controllers\DashBoardController@usuarios')->name('user.usuario');
Route::get('/consulta/ticket/{ticket}','App\Http\Controllers\DashBoardController@consulta_ticket')->name('consulta.ticket');
Route::post('/consulta/ticket','App\Http\Controllers\DashBoardController@mandarRevision')->name('revision.ticket');
Route::post('/terminar/ticket','App\Http\Controllers\DashBoardController@terminar_ticket')->name('terminar.ticket');
Route::get('/','App\Http\Controllers\DashBoardController@Panel')->name('/');
});