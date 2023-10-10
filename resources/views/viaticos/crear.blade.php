@extends('adminlte::page')

@section('title', 'CrearViaticos-VHM')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>Crear Viáticos-VHM</h1>
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
{{ Form::open(array('route' => 'viaticos.store', 'method'=>'POST')) }}
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">Monto</label>
                {!! Form::text('amount', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">Tipo: </label>
                {!! Form::select('tipeTrip',['Largo'=> 'Viaje Largo', 'Corto'=>'Viaje Corto']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">Viatico Piloto</label>
                {!! Form::text('travelAllowanceDriver', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Viatico Ayudante</label>
                {!! Form::text('travelAllowanceAssistant', null, array('class' => 'form-control')) !!}
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