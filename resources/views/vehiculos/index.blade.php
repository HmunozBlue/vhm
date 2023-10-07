@extends('adminlte::page')

@section('title', 'Vehiculos-VHM')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>Vehiculos-VHM</h1>
@stop

@section('content')
@can('crear-persona')
    <a class="btn btn-warning" href="{{ route('vehiculos.create')}}">Nuevo</a><br>
@endcan
<br>
<table  id="vehiculos" class="table table-hover">
    <thead>
        <th>ID</th>
        <th>Placa</th>
        <th>Uso</th>
        <th>tipo</th>
        <th>Marca</th>
        <th>Linea</th>
        <th>Chasis</th>
        <th>Modelo</th>
        <th>Tonelaje</th>
        <th>Vin</th>
        <th>Acciones</th>
    </thead>
    <tbody>
        @foreach ($vehicles as $vehicle)
            @if ($vehicle->active == 1)
            <tr>
                <td>{{ $vehicle->id }}</td>
                <td>{{ $vehicle->carPlate }}</td>
                <td>{{ $vehicle->use }}</td>
                <td>{{ $vehicle->tipe }}</td>
                <td>{{ $vehicle->brand }}</td>
                <td>{{ $vehicle->line }}</td>
                <td>{{ $vehicle->chasis }}</td>
                <td>{{ $vehicle->model }}</td>
                <td>{{ $vehicle->tonnage }}</td>
                <td>{{ $vehicle->vin}}</td>
                <td>
                    @can('editar-persona')
                            <a class="btn btn-primary" href="{{ route('vehiculos.edit', $vehicle->id) }}">Editar</a>
                    @endcan
                        @can('borrar-persona')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['vehiculos.destroy', $vehicle->id], 'style'=>'display:inline']) !!}
                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger', ]) !!}
                            {!! Form::close() !!}
                        @endcan
                </td>
            </tr>
            @endif
        @endforeach
    </tbody>
</table>
@stop


@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"></script>
<script src="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"></script>
<script> 
$(document).ready(function () {$('#vehiculos').DataTable();});
</script>
@stop