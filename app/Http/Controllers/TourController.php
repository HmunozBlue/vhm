<?php

namespace App\Http\Controllers;

use App\Models\tour;
use App\Models\travelAllowance;
use App\Models\Vehicles;
use App\Models\boxcars;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TourController extends Controller
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
        $tour = DB::table('tours')
        ->select('tours.id','tours.guies','tours.amount','travel_allowances.tipeTrip','vehicles.carPlate','tours.comment','tours.created_at')
        ->leftJoin('travel_allowances', 'travel_allowances.id', '=', 'tours.tipeTour')
        ->join('vehicles', 'vehicles.id', '=', 'tours.vehicleId')
        ->get();
        //$tour = tour::paginate(5);
        return view('viajes.index',compact('tour'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipeTrips = travelAllowance::paginate(25);
        $vehicles = Vehicles::all();
        $boxCars = boxcars::all();
        $personas = Persona::all();
        return view('viajes.crear',compact('tipeTrips','vehicles','boxCars','personas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'guies' => 'required',
            'amount' => 'required',
            'driverId' => 'required'
        ]);

        $newTour = new tour();

        $newTour->guies = $request->guies;
        $newTour->amount = $request->amount;
        $newTour->tipeTour = $request->tipeTour;
        $newTour->vehicleId = $request->vehicleId;
        $newTour->boxCarId = $request->boxCarId;
        $newTour->driverId = $request->driverId;
        $newTour->asistantId = $request->asistantId;
        $newTour->asistantId1 = $request->asistantId1;
        $newTour->asistantId2 = $request->asistantId2;
        $newTour->comment = $request->comment;

        $newTour->save();

        return redirect()->route('viajes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(tour $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit(tour $viaje)
    {
        $tipeTrips = travelAllowance::paginate(25);
        $vehicles = Vehicles::all();
        $boxCars = boxcars::all();
        return view('viajes.editar', compact('viaje','tipeTrips','vehicles','boxCars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tour $viaje)
    {
        
        request()->validate([
            'guies' => 'required',
            'amount' => 'required',
            'driverId' => 'required'
        ]);

        $viaje->update($request->all());

        return redirect()->route('viajes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(tour $viaje)
    {
        $viaje->delete();
        return redirect()->route('viajes.index');
    }
}
