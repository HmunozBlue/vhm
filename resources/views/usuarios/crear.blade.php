@extends('adminlte::page')

@section('title', 'Alta de usuarios-VHM')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>Alta de usuarios-VHM</h1>
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

    {!! Form::open(array('route'=>'usuarios.store', 'method'=>'POST'))!!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    {!! Form::text('name', null, array('class'=>'form-control')) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="name">Correo</label>
                    {!! Form::email('email', null, array('class'=>'form-control')) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="name">Contraseña</label>
                     <br>
                    {!! Form::password('password', null, array('class'=>'form-control')) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="name">Confirmar Contraseña</label>
                    <br>
                    {!! Form::password('confirm-password', null, array('class'=>'form-control')) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="name">Roles</label>
                    {!! Form::select('roles[]', $roles,[], array('class'=>'form-control')) !!}
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