<?php

use Illuminate\Support\Facades\Route;

// Controladores
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AdministrativoController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\HistorialClinicoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\DoctorHistorialController;
use App\Http\Controllers\BlogController;

// Página principal opcional
Route::get('/', function () {
    return view('welcome');
});

// CRUDs principales
Route::resource('clientes', ClienteController::class);
Route::resource('doctores', DoctorController::class);
Route::resource('administrativos', AdministrativoController::class);
Route::resource('tratamientos', TratamientoController::class);
Route::resource('historial', HistorialClinicoController::class);
Route::resource('horarios', HorarioController::class);
Route::resource('citas', CitaController::class);
Route::resource('pagos', PagoController::class);
Route::resource('doctor-historial', DoctorHistorialController::class)->only(['index', 'create', 'store', 'destroy']);
Route::resource('blog', BlogController::class);
