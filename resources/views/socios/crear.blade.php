@extends('adminlte::page')

@section('title', 'CrearPersonas-VHM')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>Crear Socio-VHM</h1>
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
{{ Form::open(array('route' => 'socios.store', 'method'=>'POST')) }}
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">Nombre Fiscal</label>
                {!! Form::text('fiscalName', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">Nombre Comercial</label>
                {!! Form::text('ComercialName', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">Nit</label>
                {!! Form::text('nit', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Dirección</label>
                {!! Form::text('adress', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Telefono</label>
                {!! Form::number('phone', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Correo</label>
                {!! Form::email('email', null, array('class' => 'form-control')) !!}
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