<?php

use Illuminate\Support\Facades\Route;

// Controladores
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AdministrativoController;
use App\Http\Controllers\autenticarseController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\HistorialClinicoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\DoctorHistorialController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\citasController;
use App\Http\Controllers\panelAdministrativoController;
use App\Http\Controllers\panelUsuarioController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\LoginController;

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
Route::get('/index', function(){
    return view('clinic/landingpage');
});

Route::get('/inici',[ autenticarseController::class,'index'])->name("paginainici");
Route::get('/registro',[ autenticarseController::class,'registrar'])->name("registro");
Route::get('/cita',[ citaController::class,'pedir'])->name("pedircita");
Route::get('/citas',[ citaController::class,'confirmar'])->name("citaseleccionada");
Route::get('/panel',[ panelUsuarioController::class,'index'])->name("iniciusuario");
Route::get('/panel/mostrar',[ panelUsuarioController::class,'mostrar'])->name("mostrar");
Route::get('/panel/modificar',[ panelUsuarioController::class,'cambiar'])->name("cambiar");
Route::get('/dashboard',[ panelAdministrativoController::class,'index'])->name("iniciadministrativo");
Route::get('/dashboard/disponibilidad',[ panelAdministrativoController::class,'manejarDisponibilidad'])->name("disponibilidad");
Route::get('/dashboard/agenda',[ panelAdministrativoController::class,'manejarAgenda'])->name("agenda");
Route::get('/dashboard/blog',[ panelAdministrativoController::class,'manejarBlog'])->name("blog");
Route::get('/dashboard/doctores',[ panelAdministrativoController::class,'manejarDoctores'])->name("manejodoctores");
// LOGIN
Route::get('/inici', [autenticarseController::class, 'index'])->name('paginainici');
Route::post('/inici', [autenticarseController::class, 'login'])->name('login.process');

// REGISTRO
Route::get('/registro', [autenticarseController::class, 'registrar'])->name('registro');
Route::post('/registro', [autenticarseController::class, 'register'])->name('registro.process');

// LOGOUT
Route::post('/logout', [autenticarseController::class, 'logout'])->name('logout');
