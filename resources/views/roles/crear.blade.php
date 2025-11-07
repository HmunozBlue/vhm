@extends('adminlte::page')

@section('title', 'CrearRoles-SkyNet S. A.')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>CrearRoles-SkyNet S. A.</h1>
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
    {!! Form::open(array('route' => 'roles.store', 'method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="rol">Nombre del rol</label>
                    {!! Form::text('name', null, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="rol">Permisos para este Rol</label>
                    <br>
                    @foreach ($permission as $value)
                        <label> {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                            {{ $value->name }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    {!! Form::close() !!}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop