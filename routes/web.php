<?php

use Illuminate\Support\Facades\Route;

//agrego controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\SocioController;
use App\Http\Controllers\VehiclesController;
use App\Http\Controllers\BoxCarController;
use App\Http\Controllers\TravelAllowanceController;
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
Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middelware' => ['auth']], function(){
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('personas', PersonaController::class);
    Route::resource('socios', SocioController::class);
    Route::resource('vehiculos', VehiclesController::class);
    Route::resource('furgones', BoxCarController::class);
    Route::resource('viaticos', TravelAllowanceController::class);
});
