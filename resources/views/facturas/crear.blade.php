@extends('adminlte::page')

@section('title', 'CargarFactura-VHM')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>Cargar Factura-VHM</h1>
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
{{ Form::open(array('route' => 'facturas.store', 'method'=>'POST', 'enctype'=>'multipart/form-data')) }}
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">Carga arhivos XML</label>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">Tipo: </label>
                {!! Form::file('XML', null, array('class' => 'form-control')) !!}
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