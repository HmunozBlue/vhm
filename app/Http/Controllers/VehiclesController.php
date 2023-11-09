<?php

namespace App\Http\Controllers;

//use App\Models\vehicles;
use Illuminate\Http\Request;
use App\Models\Vehicles;

class VehiclesController extends Controller
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
        $vehicles = Vehicles::paginate(25);
        return view('vehiculos.index',compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehiculos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*dd($request->all());
        die();*/
        request()->validate([
            'carPlate' => 'required',
            'vin' => 'required',
            'motor' => 'required',
            'brand' => 'required',
        ]);

        $newVehicles = new Vehicles();

        $newVehicles->use = $request->use;
        $newVehicles->tipe = $request->tipe;
        $newVehicles->line = $request->line;
        $newVehicles->chasis = $request->chasis;
        $newVehicles->serie = $request->serie;
        $newVehicles->seating = $request->seating;
        $newVehicles->axles = $request->axles;
        $newVehicles->color = $request->color;
        $newVehicles->carPlate = $request->carPlate;
        $newVehicles->brand = $request->brand;
        $newVehicles->model = $request->model;
        $newVehicles->vin = $request->vin;
        $newVehicles->motor = $request->motor;
        $newVehicles->cylinders = $request->cylinders;
        $newVehicles->tonnage = $request->tonnage;
        $newVehicles->name = $request->name;
        $newVehicles->active = 1;
        $newVehicles->save();

        return redirect()->route('vehiculos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\vehicles  $vehicles
     * @return \Illuminate\Http\Response
     */
    public function show(vehicles $vehicles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicles  $vehicles
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicles $vehiculo)
    {
        return view('vehiculos.editar', compact('vehiculo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicles  $vehicles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicles $vehiculo)
    {
        //dd($request);die();
        request()->validate([
            'carPlate' => 'required',
            'vin' => 'required',
            'chasis' => 'required',
        ]);

        $vehiculo->update($request->all());

        return redirect()->route('vehiculos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicles  $vehicles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicles $vehiculo)
    {
        $vehiculo->delete();
        return redirect()->route('vehiculos.index');
    }
}
