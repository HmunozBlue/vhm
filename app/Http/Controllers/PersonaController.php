<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;


class PersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*function __construct(){
        $this->middelware('permission:ver-persona | crear-persona | editar-persona | borrar-persona')->only('index');
        $this->middelware('permission:crear-persona', ['only'=>['create','store']]);
        $this->middelware('permission:editar-persona', ['only'=>['edit','update']]);
        $this->middelware('permission:borrar-persona', ['only'=>['destroy']]);
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::paginate(50);
        return view('personas.index',compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('personas.crear');
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
            'primerNombre' => 'required',
            'primerApellido' => 'required',
            'fechaNacimiento' => 'required',
            'CUI' => 'required',
            'NIT' => 'required',
            'pais' => 'required',
            'departamento' => 'required'
        ]);

        /*Persona::create([
            'primerNombre' => request('primerNombre'),
            'segundoNombre' => request('segundoNombre'),
            'primerApellido' => request('primerApellido'),
            'segundoApellido' => request('segundoApellido'),
            'genero' => request('genero'),
            'CUI' => request('CUI'),
            'NIT' => request('NIT'),
            'pais' => request('pais'),
            'departamento' => request('departamento'),
        ]);*/

        $newPersona = new Persona();
        $newPersona->primerNombre = $request->primerNombre;
        $newPersona->segundoNombre = $request->segundoNombre;
        $newPersona->primerApellido = $request->primerApellido;
        $newPersona->segundoApellido = $request->segundoApellido;
        $newPersona->fechaNacimiento = $request->fechaNacimiento;
        $newPersona->genero = $request->genero;
        $newPersona->CUI = $request->CUI;
        $newPersona->NIT = $request->NIT;
        $newPersona->pais = $request->pais;
        $newPersona->departamento = $request->departamento;
        $newPersona->save();

        return redirect()->route('personas.index');
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
    public function edit(Persona $persona)
    {
         return view('personas.editar', compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        request()->validate([
            'primerNombre' => 'required',
            'primerApellido' => 'required',
            'fechaNacimiento' => 'required',
            'CUI' => 'required',
            'NIT' => 'required',
            'pais' => 'required',
            'departamento' => 'required'
        ]);

        $persona->update($request->all());
        /*$input = $request->all();
        $person = Persona::find($persona);
        $person->update($input);*/

        /*$newPersonaUpdate = Persona::find($persona);

        $newPersonaUpdate->primerNombre = $request->primerNombre;
        $newPersonaUpdate->segundoNombre = $request->segundoNombre;
        $newPersonaUpdate->primerApellido = $request->primerApellido;
        $newPersonaUpdate->segundoApellido = $request->segundoApellido;
        $newPersonaUpdate->fechaNacimiento = $request->fechaNacimiento;
        $newPersonaUpdate->genero = $request->genero;
        $newPersonaUpdate->CUI = $request->CUI;
        $newPersonaUpdate->NIT = $request->NIT;
        $newPersonaUpdate->pais = $request->pais;
        $newPersonaUpdate->departamento = $request->departamento;
        $newPersonaUpdate->save();

        //$persona->update($request->all());*/
        return redirect()->route('personas.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        $persona->delete();
        return redirect()->route('personas.index');
    }
}
