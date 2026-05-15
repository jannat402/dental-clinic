<?php

use Illuminate\Support\Facades\Route;

// Controladores
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AdministrativoController;
use App\Http\Controllers\AutenticarseController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\HistorialClinicoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\DoctorHistorialController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PanelAdministrativoController;
use App\Http\Controllers\PanelUsuarioController;
use App\Http\Controllers\DoctorPanelController;
use App\Http\Controllers\PaymentController;

/* LANDING PAGE */
Route::get('/', function () {
    return view('clinic.landingpage');
})->name('landing');

/* LOGIN / REGISTRO */
Route::middleware('guest.custom')->group(function () {
    Route::get('/inici', [autenticarseController::class, 'index'])->name('paginainici');
    Route::post('/inici', [autenticarseController::class, 'login'])->name('login.process');
    Route::get('/registro', [autenticarseController::class, 'registrar'])->name('registro');
    Route::post('/registro', [autenticarseController::class, 'register'])->name('registro.process');
});
Route::post('/logout', [AutenticarseController::class, 'logout'])->name('logout');

/*  PEDIR CITA (ACCESO CLIENTE)*/
Route::middleware('cliente')->group(function () {
    Route::get('/pedircita', [CitaController::class, 'pedir'])->name('pedircita');
    Route::post('/citaseleccionada', [CitaController::class, 'confirmar'])->name('citaseleccionada');
});

/* PANEL CLIENTE */
Route::middleware('cliente')->group(function () {
    Route::get('/panel', [PanelUsuarioController::class, 'index'])->name('iniciusuario');
    Route::get('/panel/mostrar', [PanelUsuarioController::class, 'mostrar'])->name('mostrar');
    Route::get('/panel/editar/{id_cita}', [PanelUsuarioController::class, 'edit'])->name('modificar');
});

/* PANEL ADMINISTRATIVO */
Route::middleware('admin')->group(function () {
    Route::get('/dashboard', [PanelAdministrativoController::class, 'index'])->name('iniciadministrativo');
    Route::get('/dashboard/disponibilidad', [PanelAdministrativoController::class, 'manejarDisponibilidad'])->name('disponibilidad');
    Route::get('/dashboard/agenda', [PanelAdministrativoController::class, 'manejarAgenda'])->name('agenda');
    Route::get('/dashboard/blog', [PanelAdministrativoController::class, 'manejarBlog'])->name('blog');
    Route::get('/dashboard/doctores', [PanelAdministrativoController::class, 'manejarDoctores'])->name('manejodoctores');
});

/*PANEL DOCTOR */
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

    Route::get('/doctor/citas/{id_cita}/editar', [DoctorPanelController::class, 'editarCita'])->name('doctor.cita.editar');
    Route::post('/doctor/citas/{id_cita}/modificar', [DoctorPanelController::class, 'modificarCita'])->name('doctor.cita.modificar');
    Route::post('/doctor/citas/{id_cita}/cancelar', [DoctorPanelController::class, 'cancelarCita'])->name('doctor.cita.cancelar');
});

/* CRUDs PRINCIPALES */
Route::resource('clientes', ClienteController::class);
Route::resource('doctores', DoctorController::class);
Route::resource('administrativos', AdministrativoController::class);
Route::resource('tratamientos', TratamientoController::class);
Route::resource('historial', HistorialClinicoController::class);
/* HORARIOS AJAX */
Route::get('/horarios/dias/{idDoctor}', [CitaController::class, 'obtenerDias']);
Route::get('/horarios/horas/{idDoctor}/{fecha}', [CitaController::class, 'obtenerHoras']);
Route::get('/horarios/tratamientos/{idDoctor}', [CitaController::class, 'obtenerTratamientos']);

Route::resource('horarios', HorarioController::class);
Route::resource('citas', CitaController::class);
Route::resource('pagos', PagoController::class);
Route::resource('doctor-historial', DoctorHistorialController::class)->only(['index', 'create', 'store', 'destroy']);
Route::resource('blog', BlogController::class);

/* PAGOS  */
Route::get('/payment/{id_cita}', [PaymentController::class, 'index'])->name('payment.page');
Route::post('/payment/{id_cita}/process', [PaymentController::class, 'process'])->name('payment.process');
Route::get('/payment/{id_cita}/success', [PaymentController::class, 'success'])->name('payment.success');

/* 2FA */
Route::middleware('guest.custom')->group(function () {
    Route::get('/2fa/verify', [App\Http\Controllers\TwoFactorController::class, 'index'])->name('2fa.form');
    Route::any('/2fa/enviar', [App\Http\Controllers\TwoFactorController::class, 'enviarCodi'])->name('2fa.enviar');
    Route::any('/2fa/verificar', [App\Http\Controllers\TwoFactorController::class, 'verificar'])->name('2fa.verificar');
});
