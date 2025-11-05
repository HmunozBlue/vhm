<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Partners;
use App\Models\User;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Events\VisitFinish;
use Illuminate\Support\Facades\Log;


class VisitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*// Carga las visitas con las relaciones de socio y persona
        $visits = Visit::with(['partner','persona'])->get();
        return view('visitas.index',compact('visits'));*/
        $user = Auth::user();

        // Si el usuario es administrador, ve todas las visitas
        if ($user->hasRole('administrador')) {
            $visits = Visit::with(['partner', 'persona'])->get();
        } 
        // Si es supervisor, solo sus visitas
        elseif ($user->hasRole('Supervisor')) {
            $visits = Visit::with(['partner', 'persona'])
                ->where('supervisor_id', $user->id)
                ->get();
        } elseif ($user->hasRole('Tecnico')) {
            // Obtener el ID de la persona asociada al usuario
            $personaId = $user->persona ? $user->persona->id : null;
            // Obtener las visitas asignadas al técnico
            $visits = Visit::with(['partner', 'persona'])
                ->where('technician_id', $personaId)
                ->get();
        } else {
            // Otros roles no tienen acceso
            abort(403, 'No tienes permiso para ver estas visitas.');
        }
        return view('visitas.index', compact('visits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partners = Partners::all();
        $personas = Persona::all();
        return view('visitas.crear', compact('partners', 'personas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'partner_id' => 'required',
            'technician_id' => 'required',
            'visit_date' => 'required|date',
        ]);

        Visit::create([
            'partner_id' => $request->partner_id,
            'technician_id' => $request->technician_id,
            'supervisor_id' => Auth::id(),
            'visit_date' => $request->visit_date,
            'planned_time' => $request->planned_time,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'status' => 'planificada',
        ]);

        return redirect()->route('visitas.index')->with('success', 'Visita planificada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visit = Visit::findOrFail($id);
        return view('visitas.mostrar', compact('visit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function checkIn($id)
    {
        $visit = Visit::findOrFail($id);
        $visit->check_in_time = now();
        $visit->status = 'en_progreso';
        $visit->save();

        return back()->with('success', 'Ingreso registrado.');
    }

    public function checkOut($id)
    {
        $visit = Visit::findOrFail($id);
        $visit->check_out_time = now();
        $visit->status = 'completada';
        $visit->save();

        Log::info('Evento lanzado para visita ID: '.$visit->id);

        $send = event(new VisitFinish($visit));

        return back()->with('success', 'Salida registrada.');
    }
}
