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
use App\Http\Controllers\panelAdministrativoController;
use App\Http\Controllers\panelUsuarioController;
use App\Http\Controllers\DoctorPanelController;

// LANDING PAGE
Route::get('/', function () {
    return view('clinic.landingpage');
});

// LOGIN / REGISTRO
Route::get('/inici', [autenticarseController::class, 'index'])->name('paginainici');
Route::post('/inici', [autenticarseController::class, 'login'])->name('login.process');

Route::get('/registro', [autenticarseController::class, 'registrar'])->name('registro');
Route::post('/registro', [autenticarseController::class, 'register'])->name('registro.process');

Route::post('/logout', [autenticarseController::class, 'logout'])->name('logout');

// PEDIR CITA
Route::get('/pedircita', [CitaController::class, 'pedir'])->name('pedircita');
Route::post('/citaseleccionada', [CitaController::class, 'confirmar'])->name('citaseleccionada');

// PANEL CLIENTE (PROTEGIDO)
Route::middleware('cliente')->group(function () {

    Route::get('/panel', [panelUsuarioController::class, 'index'])->name('iniciusuario');
    Route::get('/panel/mostrar', [panelUsuarioController::class, 'mostrar'])->name('mostrar');
    Route::get('/panel/modificar', [panelUsuarioController::class, 'cambiar'])->name('cambiar');

});

// PANEL ADMINISTRATIVO (PROTEGIDO)
Route::middleware('admin')->group(function () {

    Route::get('/dashboard', [panelAdministrativoController::class, 'index'])->name('iniciadministrativo');
    Route::get('/dashboard/disponibilidad', [panelAdministrativoController::class, 'manejarDisponibilidad'])->name('disponibilidad');
    Route::get('/dashboard/agenda', [panelAdministrativoController::class, 'manejarAgenda'])->name('agenda');
    Route::get('/dashboard/blog', [panelAdministrativoController::class, 'manejarBlog'])->name('blog');
    Route::get('/dashboard/doctores', [panelAdministrativoController::class, 'manejarDoctores'])->name('manejodoctores');

});

// RUTAS DEL DOCTOR (PROTEGIDAS)
Route::middleware('doctor')->group(function () {

    Route::get('/doctor/agenda', [DoctorPanelController::class, 'agenda'])->name('doctor.agenda');

    Route::get('/doctor/citas', [DoctorPanelController::class, 'citas'])->name('doctor.citas');

    Route::get('/doctor/historial', [DoctorPanelController::class, 'historial'])->name('doctor.historial');

    Route::get('/doctor/historial/{id_cliente}', [DoctorPanelController::class, 'verHistorial'])->name('doctor.historial.ver');

    Route::get('/doctor/notas/{id_cita}', [DoctorPanelController::class, 'notas'])->name('doctor.notas');
    Route::post('/doctor/notas/{id_cita}', [DoctorPanelController::class, 'guardarNotas'])->name('doctor.notas.guardar');

    Route::get('/doctor/seguimiento', [DoctorPanelController::class, 'seguimiento'])->name('doctor.seguimiento');

    Route::get('/doctor/seguimiento/crear/{id_cliente}', [DoctorPanelController::class, 'crearSeguimiento'])->name('doctor.seguimiento.crear');
    Route::post('/doctor/seguimiento/crear/{id_cliente}', [DoctorPanelController::class, 'guardarSeguimiento'])->name('doctor.seguimiento.guardar');

});

// CRUDs PRINCIPALES
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

// HORARIO CITAS
Route::get('/horarios/dias/{idDoctor}', [CitaController::class, 'obtenerDias']);
Route::get('/horarios/horas/{idDoctor}/{fecha}', [CitaController::class, 'obtenerHoras']);

