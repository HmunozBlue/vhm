@extends('adminlte::page')

@section('title', 'CrearVehiculos-VHM')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>Crear Vehículo-VHM</h1>
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
{{ Form::open(array('route' => 'vehiculos.store', 'method'=>'POST')) }}
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">Placa</label>
                {!! Form::text('carPlate', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Marca</label>
                {!! Form::text('brand', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">Uso</label>
                {!! Form::text('use', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="rol">Tipo</label>
                {!! Form::text('tipe', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Linea</label>
                {!! Form::text('line', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">chasis</label>
                {!! Form::text('chasis', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">serie</label>
                {!! Form::text('serie', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Asientos</label>
                {!! Form::text('seating', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Ejes</label>
                {!! Form::text('axles', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Color</label>
                {!! Form::text('color', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Modelo</label>
                {!! Form::text('model', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Vin</label>
                {!! Form::text('vin', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Motor</label>
                {!! Form::text('motor', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Cilindros</label>
                {!! Form::text('cylinders', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Tonelaje</label>
                {!! Form::text('tonnage', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="rol">Nombre</label>
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
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