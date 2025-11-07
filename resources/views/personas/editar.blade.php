@extends('adminlte::page')

@section('title', 'EditarPersona-SkyNet S. A.')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>EditarPersona-SkyNet S. A.</h1>
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

{!! Form::model($persona, ['method' => 'PUT', 'route' => ['personas.update', $persona->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="rol">Primer Nombre</label>
            {!! Form::text('primerNombre', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="rol">Otros Nombres</label>
            {!! Form::text('segundoNombre', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="rol">Primer Apellido</label>
            {!! Form::text('primerApellido', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="rol">Segundo Apellido</label>
            {!! Form::text('segundoApellido', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="rol">Genero: </label>
            {!! Form::select('genero',['M'=> 'Masculino', 'F'=>'Femenino']) !!}
        </div>
        <br>
        <div class="form-group">
            <label for="rol">FechaNacimiento: </label>
            {!! Form::date('fechaNacimiento') !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="rol">DPI</label>
            {!! Form::text('CUI', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="rol">NIT</label>
            {!! Form::text('NIT', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="rol">Pais</label>
            {!! Form::text('pais', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="rol">Departamento</label>
            {!! Form::text('departamento', null, array('class' => 'form-control')) !!}
        </div>
    </div>
</div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
{!! Form::close() !!}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop