@extends('adminlte::page')

@section('title', 'EditarRol-VHM')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>EditarRol-VHM</h1>
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

{!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update', $role->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="name">Nombre del rol</label>
                {!! Form::text('name', null, array('class'=>'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="name">Permisos para este Rol:</label>
                <br>
                @foreach ($permission as $value)
                    <label>
                        {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false ) }}
                        {{ $value->name }}
                    </label>
                @endforeach
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