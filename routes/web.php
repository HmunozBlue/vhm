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
use App\Http\Controllers\BillingController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AssitantController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\VisitController;
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

Route::resource('contacto', ContactController::class);

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
    Route::resource('facturas', BillingController::class);
    Route::resource('viajes', TourController::class);
    Route::resource('pagos', PaymentController::class);
    Route::resource('ayudantes', AssitantController::class);
    Route::resource('visitas', VisitController::class);
    // Ruta para hacer check-in de una visita
Route::get('/visitas/{id}/check-in', [VisitController::class, 'checkIn'])->name('visitas.checkIn');
    // Ruta para hacer check-out de una visita
Route::get('/visitas/{id}/check-out', [VisitController::class, 'checkOut'])->name('visitas.checkOut');
});
