<?php

namespace App\Http\Controllers;

use App\Models\travelAllowance;
use Illuminate\Http\Request;

class TravelAllowanceController extends Controller
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
        $viaticos = travelAllowance::paginate(25);
        return view('viaticos.index',compact('viaticos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('viaticos.crear');
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
        //die();
        request()->validate([
            'amount' => 'required',
            'tipeTrip' => 'required'
        ]);

        $newTravelAllow = new travelAllowance();

        $newTravelAllow->amount = $request->amount;
        $newTravelAllow->tipeTrip = $request->tipeTrip;
        $newTravelAllow->travelAllowanceDriver = $request->travelAllowanceDriver;
        $newTravelAllow->travelAllowanceAssistant = $request->travelAllowanceAssistant;

        $newTravelAllow->save();

        return redirect()->route('viaticos.index');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\travelAllowance  $travelAllowance
     * @return \Illuminate\Http\Response
     */
    public function show(travelAllowance $travelAllowance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\travelAllowance  $travelAllowance
     * @return \Illuminate\Http\Response
     */
    public function edit(travelAllowance $viatico)
    {
        return view('viaticos.editar', compact('viatico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\travelAllowance  $travelAllowance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, travelAllowance $viatico)
    {
        request()->validate([
            'amount' => 'required',
            'tipeTrip' => 'required'
        ]);

        $viatico->update($request->all());

        return redirect()->route('viaticos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\travelAllowance  $travelAllowance
     * @return \Illuminate\Http\Response
     */
    public function destroy(travelAllowance $viatico)
    {
        $viatico->delete();
        return redirect()->route('viaticos.index');
    }
}
