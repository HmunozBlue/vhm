<?php

namespace App\Http\Controllers;

use App\Models\assitant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssitantController extends Controller
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
    public function index(Request $request)
    {
        //filtro de fechas desde el form index
        $dateStart = $request->input('fechaInicio', now()->subDays(5)->format('Y-m-d'));
        $dateEnd = $request->input('fechaFin', now()->format('Y-m-d'));
        $assistent = ($request->assitant == null) ? 'asistantId' : $request->assitant;

        //Consulta a la bd 
        $paymentsAssitent = DB::table('tours')
        ->select('tours.id','tours.guies','travel_allowances.tipeTrip','travel_allowances.travelAllowanceAssistant','vehicles.carPlate AS vehicle','boxcars.carPlate AS boxcar',
        'boxcars.tonnage','personas.primerNombre','personas.primerApellido','personas.CUI','tours.created_at')
        ->leftJoin('travel_allowances', 'travel_allowances.id', '=', 'tours.tipeTour')
        ->join('vehicles', 'vehicles.id', '=', 'tours.vehicleId')
        ->join('boxcars', 'boxcars.id', '=', 'tours.boxCarId')
        ->join('personas', 'personas.id', '=', "tours.$assistent")
        ->whereBetween('tours.created_at', ["$dateStart 00:01:00","$dateEnd 23:59:59"])
        ->orderBy('tours.created_at', 'DESC')
        ->get();

        //Retorna a la vista index de la carpeta ayudantes, con la información
        return view('ayudantes.index',compact('paymentsAssitent','dateStart','dateEnd','assistent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\assitant  $assitant
     * @return \Illuminate\Http\Response
     */
    public function show(assitant $assitant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\assitant  $assitant
     * @return \Illuminate\Http\Response
     */
    public function edit(assitant $assitant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\assitant  $assitant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, assitant $assitant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\assitant  $assitant
     * @return \Illuminate\Http\Response
     */
    public function destroy(assitant $assitant)
    {
        //
    }
}
