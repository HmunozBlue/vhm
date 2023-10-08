<?php

namespace App\Http\Controllers;

use App\Models\boxcars;
use Illuminate\Http\Request;

class BoxCarController extends Controller
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
        $boxcars = boxcars::paginate(5);
        return view('furgones.index',compact('boxcars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('furgones.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request->all());
        // die();
        request()->validate([
            'carPlate' => 'required',
            'vin' => 'required',
            'chasis' => 'required',
            'serie' => 'required',
        ]);

        $newboxcars = new boxcars();

        $newboxcars->carPlate = $request->carPlate;
        $newboxcars->brand = $request->brand;
        $newboxcars->use = $request->use;
        $newboxcars->tipe = $request->tipe;
        $newboxcars->chasis = $request->chasis;
        $newboxcars->serie = $request->serie;
        $newboxcars->axles = $request->axles;
        $newboxcars->color = $request->color;
        $newboxcars->model = $request->model;
        $newboxcars->vin = $request->vin;
        $newboxcars->tonnage = $request->tonnage;
        $newboxcars->name = $request->name;
        $newboxcars->active = 1;
        $newboxcars->save();

        return redirect()->route('furgones.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\boxcars  $boxcars
     * @return \Illuminate\Http\Response
     */
    public function show(boxcars $boxcars)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\boxcars  $boxcars
     * @return \Illuminate\Http\Response
     */
    public function edit(boxcars $furgone)
    {
        return view('furgones.editar', compact('furgone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\boxcars  $boxcars
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, boxcars $furgone)
    {
        request()->validate([
            'carPlate' => 'required',
            'vin' => 'required',
            'chasis' => 'required',
        ]);

        $furgone->update($request->all());

        return redirect()->route('furgones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\boxcars  $boxcars
     * @return \Illuminate\Http\Response
     */
    public function destroy(boxcars $furgone)
    {
        
        $furgone->delete();
        return redirect()->route('furgones.index');
    }
}
