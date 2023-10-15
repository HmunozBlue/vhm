@extends('adminlte::page')

@section('title', 'EditarFactura-VHM')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>Editar Factura - VHM</h1>
@stop

@section('content')
@if ($errors->any())
<div class="alert alert-dark alert-dismissible fade show" role="alert">
    <strong>Revise todos los campos</strong>
    @foreach ($errors->all() as $error)
        <span>{{ $error }}</span>
    @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

{!! Form::model($factura, ['method' => 'PUT', 'route' => ['facturas.update', $factura->id]]) !!}
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">Codigo</label>
                {!! Form::text('currencyCode', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">Fecha Emisión</label>
                {!! Form::text('dateTimeEmission', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">tipo</label>
                {!! Form::text('type', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Dirección</label>
                {!! Form::text('addressSender', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Municipio</label>
                {!! Form::text('munSender', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Departamento</label>
                {!! Form::text('depSender', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Pais</label>
                {!! Form::text('country', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Nit</label>
                {!! Form::text('nitSender', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Nombre Comercio</label>
                {!! Form::text('comerceName', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Nombre</label>
                {!! Form::text('senderName', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Nit Receptor</label>
                {!! Form::text('idReceptor', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Nombre Receptor</label>
                {!! Form::text('nameReceptor', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Monto</label>
                {!! Form::text('amount', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Descripción</label>
                {!! Form::text('description', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Precio unitario</label>
                {!! Form::text('unitPrice', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Precio</label>
                {!! Form::text('price', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Tipo de Impuesto</label>
                {!! Form::text('typeTax', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Monto Gravable</label>
                {!! Form::text('amountTaxable', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Monto Impuesto</label>
                {!! Form::text('amountTax', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Total</label>
                {!! Form::text('total', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Bien o servicio</label>
                {!! Form::text('bienOservice', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Nit Certificador</label>
                {!! Form::text('nitCertifier', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Nombre Certificador</label>
                {!! Form::text('nameCertifier', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Autorizacion</label>
                {!! Form::text('numAutorization', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">serie</label>
                {!! Form::text('serie', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Numero</label>
                {!! Form::text('number', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Fecha Certificacion</label>
                {!! Form::text('dateTimeCertification', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <br>
    </div><!--Fin div row-->
</div><!--Fin div Container-->
{{ Form::close() }}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop