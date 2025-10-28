<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partners;

class SocioController extends Controller
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
        $partners = Partners::paginate(25);
        return view('socios.index',compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('socios.crear');
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

        request()->validate([
            'ComercialName' => 'required',
            'nit' => 'required',
        ]);

        $newPartner = new Partners();
        $newPartner->fiscalName = $request->fiscalName;
        $newPartner->ComercialName = $request->ComercialName;
        $newPartner->nit = $request->nit;
        $newPartner->adress = $request->fiscalName;
        $newPartner->phone = $request->phone;
        $newPartner->email = $request->email;
        $newPartner->latitude = $request->latitude;
        $newPartner->longitude = $request->longitude;
        $newPartner->save();

        return redirect()->route('socios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Partners $socio)
    {
        /*dd($partner->all());
        die();*/
        return view('socios.editar', compact('socio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partners $socio)
    {
        request()->validate([
            'ComercialName' => 'required',
            'nit' => 'required',
        ]);

        $socio->update($request->all());

        return redirect()->route('socios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partners $socio)
    {
        $socio->delete();
        return redirect()->route('socios.index');
    }
}
