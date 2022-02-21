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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'App\Http\Controllers\DashBoardController@index')->name('dashboard');


Route::group(['middleware' => ['auth']], function () {
Route::resources([
    'planteles' => 'App\Http\Controllers\PlantelesController',
    'usuarios' => 'App\Http\Controllers\UserController',
    'areas' => 'App\Http\Controllers\AreasController',

]);


});