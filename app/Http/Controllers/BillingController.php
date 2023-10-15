<?php

namespace App\Http\Controllers;

use App\Models\billing;
use Illuminate\Http\Request;

class BillingController extends Controller
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
        $billing = billing::paginate(5);
        return view('facturas.index',compact('billing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('facturas.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->XML);
        // die();
        $fileFactura = $_FILES["XML"];

        $xmlContent = file_get_contents($fileFactura["tmp_name"]);
        $xmlContent = str_replace("<dte:", "<", $xmlContent);
        $xmlContent = str_replace("</dte:", "</", $xmlContent);
        $xmlContent = simplexml_load_string($xmlContent);
        $xmlContent = get_object_vars($xmlContent);
        //SAT
        $xmlData["SAT"] = (array) $xmlContent["SAT"];
        $xmlData["SAT"]["DTE"] = (array) $xmlData["SAT"]["DTE"];
        $xmlData["SAT"]["DTE"]["DatosEmision"] = (array) $xmlData["SAT"]["DTE"]["DatosEmision"];
        $xmlData["SAT"]["DTE"]["DatosEmision"]["DatosGenerales"] = (array) $xmlData["SAT"]["DTE"]["DatosEmision"]["DatosGenerales"];
        $xmlData["SAT"]["DTE"]["DatosEmision"]["DatosGenerales"]["CodigoMoneda"] = $xmlData["SAT"]["DTE"]["DatosEmision"]["DatosGenerales"]["@attributes"]["CodigoMoneda"];
        $xmlData["SAT"]["DTE"]["DatosEmision"]["DatosGenerales"]["FechaHoraEmision"] = $xmlData["SAT"]["DTE"]["DatosEmision"]["DatosGenerales"]["@attributes"]["FechaHoraEmision"];
        $xmlData["SAT"]["DTE"]["DatosEmision"]["DatosGenerales"]["Tipo"] = $xmlData["SAT"]["DTE"]["DatosEmision"]["DatosGenerales"]["@attributes"]["Tipo"];
        //Emisor
        $xmlData["EMISOR"] = (array) $xmlData["SAT"]["DTE"]["DatosEmision"]["Emisor"];
        $xmlData["EMISOR"]["NITEmisor"] = (array) $xmlData["SAT"]["DTE"]["DatosEmision"]["Emisor"]["NITEmisor"];
        $xmlData["EMISOR"]["NombreComercial"] = (array) $xmlData["SAT"]["DTE"]["DatosEmision"]["Emisor"]["NombreComercial"];
        $xmlData["EMISOR"]["NombreEmisor"] = (array) $xmlData["SAT"]["DTE"]["DatosEmision"]["Emisor"]["NombreEmisor"];

        //direccionEmisor
        $xmlData["EMISOR"]["DireccionEmisor"] = (array) $xmlData["EMISOR"]["DireccionEmisor"];
        $xmlData["Direccion"] = $xmlData["EMISOR"]["DireccionEmisor"]["Direccion"];
        $xmlData["Municipio"] = $xmlData["EMISOR"]["DireccionEmisor"]["Municipio"];
        $xmlData["Departamento"] = $xmlData["EMISOR"]["DireccionEmisor"]["Departamento"];
        $xmlData["Pais"] = $xmlData["EMISOR"]["DireccionEmisor"]["Pais"];

        //Receptor
        $xmlData["Receptor"] = (array) $xmlData["SAT"]["DTE"]["DatosEmision"]["Receptor"];
        $xmlData["IDReceptor"] = (array) $xmlData["SAT"]["DTE"]["DatosEmision"]["Receptor"]["IDReceptor"];
        $xmlData["NombreReceptor"] = (array) $xmlData["SAT"]["DTE"]["DatosEmision"]["Receptor"]["NombreReceptor"];

        //ITEMS
        $xmlData["ITEMS"] = (array) $xmlData["SAT"]["DTE"]["DatosEmision"]["Items"];
        $xmlData["ITEM"] = (array) $xmlData["ITEMS"]["Item"];
        $xmlData["Cantidad"] =  intval($xmlData["ITEM"]["Cantidad"]);
        $xmlData["Descripcion"] =  $xmlData["ITEM"]["Descripcion"];
        $xmlData["PrecioUnitario"] =  floatval($xmlData["ITEM"]["PrecioUnitario"]);
        $xmlData["Precio"] =  $xmlData["ITEM"]["Precio"];
        $xmlData["Total"] =  $xmlData["ITEM"]["Total"];

        //IMPUESTOS
        $xmlData["Item"] = (array) $xmlData["ITEMS"]["Item"];
        $xmlData["Impuestos"]= (array) $xmlData["Item"]["Impuestos"];
        $xmlData["Impuesto"] =  (array) $xmlData["Impuestos"]["Impuesto"];
        $xmlData["NombreCorto"] = $xmlData["Impuesto"]["NombreCorto"];
        $xmlData["MontoGravable"] = $xmlData["Impuesto"]["MontoGravable"];
        $xmlData["MontoImpuesto"] = $xmlData["Impuesto"]["MontoImpuesto"];

        //Bien o servicio
        //$xmlData["Item"] = (array) $xmlData["ITEMS"]["Item"];
        $xmlData["attributos"]=$xmlData["Item"]["@attributes"];
        $xmlData["bienOServicio"]=$xmlData["attributos"]["BienOServicio"];

        //Certificador
        $xmlData["CERTIFICADOR"]= (array ) $xmlData["SAT"]["DTE"]["Certificacion"];
        $xmlData["NITCertificador"]=$xmlData["CERTIFICADOR"]["NITCertificador"];
        $xmlData["NombreCertificador"]=$xmlData["CERTIFICADOR"]["NombreCertificador"];
        $xmlData["NumeroAutorizacion"]=$xmlData["CERTIFICADOR"]["NumeroAutorizacion"];
        $xmlData["FechaHoraCertificacion"]=$xmlData["CERTIFICADOR"]["FechaHoraCertificacion"];


        //instancia para guardar en la bd
        $newBilling = new billing();
        $newBilling->currencyCode = $xmlData["SAT"]["DTE"]["DatosEmision"]["DatosGenerales"]["CodigoMoneda"];
        $newBilling->dateTimeEmission = $xmlData["SAT"]["DTE"]["DatosEmision"]["DatosGenerales"]["FechaHoraEmision"];
        $newBilling->type = $xmlData["SAT"]["DTE"]["DatosEmision"]["DatosGenerales"]["Tipo"];
        $newBilling->addressSender =  $xmlData["Direccion"];
        $newBilling->munSender = $xmlData["Municipio"];
        $newBilling->country = $xmlData["Pais"];
        $newBilling->depSender = $xmlData["Departamento"];
        $newBilling->nitSender = $xmlData["EMISOR"]["NITEmisor"][0];
        $newBilling->comerceName = $xmlData["EMISOR"]["NombreComercial"][0];
        $newBilling->senderName = $xmlData["EMISOR"]["NombreEmisor"][0];
        $newBilling->idReceptor =  $xmlData["IDReceptor"][0];
        $newBilling->nameReceptor = $xmlData["NombreReceptor"][0];
        $newBilling->amount = $xmlData["Cantidad"];
        $newBilling->description =$xmlData["Descripcion"];
        $newBilling->unitPrice = $xmlData["PrecioUnitario"];
        $newBilling->price = $xmlData["Precio"];
        $newBilling->typeTax = $xmlData["NombreCorto"];
        $newBilling->amountTaxable = $xmlData["MontoGravable"];
        $newBilling->amountTax = $xmlData["MontoImpuesto"];
        $newBilling->total = $xmlData["Total"];
        $newBilling->bienOservice = $xmlData["bienOServicio"];
        $newBilling->nitCertifier = $xmlData["NITCertificador"];
        $newBilling->nameCertifier = $xmlData["NombreCertificador"];
        $newBilling->numAutorization = $xmlData["NumeroAutorizacion"];
        $newBilling->serie = 1;
        $newBilling->number = 1;
        $newBilling->dateTimeCertification = $xmlData["FechaHoraCertificacion"];

        $newBilling->save();

        return redirect()->route('facturas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function show(billing $billing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function edit(billing $factura)
    {
        return view('facturas.editar', compact('factura'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, billing $factura)
    {
        $factura->update($request->all());

        return redirect()->route('facturas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\billing  $billing
     * @return \Illuminate\Http\Response
     */
    public function destroy(billing $factura)
    {
        $factura->delete();
        return redirect()->route('facturas.index');
    }
}
