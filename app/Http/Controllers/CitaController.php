<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Doctor;
use App\Models\Tratamiento;
use App\Models\Administrativo;
use App\Models\Horario;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with(['cliente', 'doctor', 'tratamiento', 'administrativo'])->get();
        return view('citas.index', compact('citas'));
    }

    public function pedir(){
        $mesNumero = Carbon::now()->month; // 1–12  
        $mesNombre = '';

        switch ($mesNumero) {
            case 1:  $mesNombre = 'Enero'; break;
            case 2:  $mesNombre = 'Febrero'; break;
            case 3:  $mesNombre = 'Marzo'; break;
            case 4:  $mesNombre = 'Abril'; break;
            case 5:  $mesNombre = 'Mayo'; break;
            case 6:  $mesNombre = 'Junio'; break;
            case 7:  $mesNombre = 'Julio'; break;
            case 8:  $mesNombre = 'Agosto'; break;
            case 9:  $mesNombre = 'Septiembre'; break;
            case 10: $mesNombre = 'Octubre'; break;
            case 11: $mesNombre = 'Noviembre'; break;
            case 12: $mesNombre = 'Diciembre'; break;
        }
        return view("clinic.seleccionarcita",['mesNombre'=>$mesNombre]);
    }
    public function confirmar(){
        return view("clinic.citaseleccionada");
    }





    public function create()
    {
        return view('citas.create', [
            'clientes' => Cliente::all(),
            'doctores' => Doctor::all(),
            'tratamientos' => Tratamiento::all(),
            'admins' => Administrativo::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:cliente,id_cliente',
            'id_doctor' => 'required|exists:doctor,id_doctor',
            'id_tratamiento' => 'required|exists:tratamiento,id_tratamiento',
            'id_admin' => 'nullable|exists:administrativo,id_admin',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'estado' => 'required|in:reservada,cancelada,completada,pendiente_pago',
            'tipo_reserva' => 'required|in:online,presencial'
        ]);

        Cita::create($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita creada correctamente');
    }

    public function show($id)
    {
        $cita = Cita::with(['cliente', 'doctor', 'tratamiento', 'administrativo'])->findOrFail($id);
        return view('citas.show', compact('cita'));
    }

    public function edit($id)
    {
        $cita = Cita::findOrFail($id);

        return view('citas.edit', [
            'cita' => $cita,
            'clientes' => Cliente::all(),
            'doctores' => Doctor::all(),
            'tratamientos' => Tratamiento::all(),
            'admins' => Administrativo::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);

        $request->validate([
            'id_cliente' => 'required|exists:cliente,id_cliente',
            'id_doctor' => 'required|exists:doctor,id_doctor',
            'id_tratamiento' => 'required|exists:tratamiento,id_tratamiento',
            'id_admin' => 'nullable|exists:administrativo,id_admin',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'estado' => 'required|in:reservada,cancelada,completada,pendiente_pago',
            'tipo_reserva' => 'required|in:online,presencial'
        ]);

        $cita->update($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente');
    }

    public function destroy($id)
    {
        Cita::destroy($id);
        return redirect()->route('citas.index')->with('success', 'Cita eliminada');
    }

public function horariosDisponibles(Request $request)
{
    $horarioDia = Horario::all()->where("id_doctor",$request->doctorSeleccionado)->where("fecha","2026-04-" . $request->dia)->first();
    
    if (!$horarioDia) {
        return response()->json([
            'ok' => false,
            'mensaje' => 'No hay horario disponible para este día'
        ]);
    }
    
    $tratamiento = Tratamiento::find($request->tratamiento);
    $duracion = $tratamiento ? $tratamiento->duracion_minutos : 60;
    
    $horas = $this->generarFranjasHorarias($horarioDia->hora_inicio, $horarioDia->hora_fin,$request->doctorSeleccionado,new DateTime("2026-04-" . $request->dia), $duracion);
    return response()->json([
        'ok' => true,
        //'doctor' => $doctor->nombre . $doctor->apellidos,
        'doctor_id'=>$request->doctorSeleccionado,
        'fecha' =>"2026-04-" . $request->dia,
        'horario' => $horarioDia,
        'horas'=>$horas,
        'duracion' => $duracion,
        'precio' => $tratamiento ? $tratamiento->precio : 0
    ]);
}


   private function sePuedeReservar($fecha, $horaInicio, $horaFin, $doctor): bool
    {
        // ❌ ANTES: comparación incorrecta y orWhere sin agrupar
        // ✔️ AHORA: fórmula universal de solapamiento
        //
        // Dos intervalos se solapan si:
        // inicio_existente < fin_nueva  AND  fin_existente > inicio_nueva

        $haySolape = Cita::where('id_doctor', $doctor)
            ->where('fecha', $fecha)
            ->where(function ($q) use ($horaInicio, $horaFin) {
                $q->where('hora_inicio', '<', $horaFin->format('H:i:s'))
                  ->where('hora_fin', '>', $horaInicio->format('H:i:s'));
            })
            ->exists();
            
        $hayHorario = Horario::where('id_doctor', $doctor)
            ->where('fecha', $fecha)
            ->where('hora_inicio', '<', $horaInicio->format('H:i:s'))
            ->where('hora_fin', '>', $horaFin->format('H:i:s'))
            ->exists();
            
        $sePuedeReservar = !$haySolape  && $hayHorario;

        return $sePuedeReservar;
    }



//funcion que crea las franjas y mira cuales son disponibles
function generarFranjasHorarias($inicio, $fin,$doctor,$fecha, $duracionTratamiento = 60)
{
    // Convertir a DateTime si son strings
    if (is_string($inicio)) $inicio = DateTime::createFromFormat('H:i:s', $inicio);
    if (is_string($fin)) $fin = DateTime::createFromFormat('H:i:s', $fin);
    
    $intervalo = new DateInterval('PT15M');
    $duracion = new DateInterval('PT' . $duracionTratamiento . 'M');
    $franjas = [];
    $actual = clone $inicio;
    
    while ($actual <= $fin) {
        $horaStr = $actual->format('H:i'); // Solo horas y minutos para la vista
        $inicioHoraActual = clone $actual;
        $finHoraActual = (clone $actual)->add($duracion);
        
        $franjas[] = [
            'hora' => $horaStr,
            'disponible' => $this->sePuedeReservar($fecha,$inicioHoraActual,$finHoraActual,$doctor)
        ];
        
        $actual = $actual->add($intervalo);
    }
    
return $franjas;
}

public function reservar(Request $request)
{
    $request->validate([
        'doctor' => 'required',
        'tratamiento' => 'required',
        'fecha' => 'required',
        'hora_inicio' => 'required'
    ]);
    
    $fecha = $request->fecha;
    $horaInicio = new DateTime($request->hora_inicio);
    $duracion = (int)($request->duracion ?? 60);
    $horaFin = (clone $horaInicio)->add(new DateInterval('PT' . $duracion . 'M'));
    $doctor = $request->doctor;
    
    if (!$this->sePuedeReservar($fecha, $horaInicio, $horaFin, $doctor)) {
        return response()->json([
            'ok' => false,
            'mensaje' => 'El horario ya no está disponible'
        ]);
    }
    
    $cita = Cita::create([
        'id_cliente' => $request->cliente ?? 1,
        'id_doctor' => $doctor,
        'id_tratamiento' => $request->tratamiento,
        'id_admin' => null,
        'fecha' => $fecha,
        'hora_inicio' => $horaInicio->format('H:i:s'),
        'hora_fin' => $horaFin->format('H:i:s'),
        'estado' => 'reservada',
        'tipo_reserva' => 'online',
        'fecha_dato' => now(),
        'fecha_carga' => now()
    ]);
    
    return response()->json([
        'ok' => true,
        'mensaje' => 'Cita reservada correctamente',
        'cita' => $cita
    ]);
}

     
}



