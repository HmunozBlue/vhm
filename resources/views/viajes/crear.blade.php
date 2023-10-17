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
{{ Form::open(array('route' => 'viajes.store', 'method'=>'POST')) }}
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">No Guia</label>
                {!! Form::text('guies', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">Precio: </label>
                {!! Form::number('amount', null, array('class' => 'form-control', 'step' => '.01')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">Tipo de Viaje</label>
                <select name="tipeTour" id="tipeTour" class="form-control">
                    @foreach ($tipeTrips as $tipe)
                        <option value="{{ $tipe->id }}"> {{ $tipe->tipeTrip }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="rol">Vehiculo: </label>
                <select name="vehicleId" id="vehicleId" class="form-control">
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}"> {{ $vehicle->carPlate }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="rol">Furgon: </label>
                <select name="boxCarId" id="boxCarId" class="form-control">
                    @foreach ($boxCars as $boxCar)
                        <option value="{{ $boxCar->id }}"> {{ $boxCar->carPlate }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">IdPiloto: </label>
                {!! Form::number('driverId', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Ayudante: </label>
                {!! Form::number('asistantId', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Ayudante: </label>
                {!! Form::number('asistantId1', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Ayudante: </label>
                {!! Form::number('asistantId2', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Observaciones: </label>
                {!! Form::textarea('comment', null, array('class' => 'form-control')) !!}
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