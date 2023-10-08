@extends('adminlte::page')

@section('title', 'Furgones-VHM')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>Furgones-VHM</h1>
@stop

@section('content')
@can('crear-persona')
    <a class="btn btn-warning" href="{{ route('furgones.create')}}">Nuevo</a><br>
@endcan
<br>
<table  id="furgones" class="table table-hover">
    <thead>
        <th>ID</th>
        <th>Placa</th>
        <th>Uso</th>
        <th>tipo</th>
        <th>Marca</th>
        <th>Chasis</th>
        <th>Modelo</th>
        <th>Tonelaje</th>
        <th>Vin</th>
        <th>Acciones</th>
    </thead>
    <tbody>
        @foreach ($boxcars as $boxcar)
            @if ($boxcar->active == 1)
            <tr>
                <td>{{ $boxcar->id }}</td>
                <td>{{ $boxcar->carPlate }}</td>
                <td>{{ $boxcar->use }}</td>
                <td>{{ $boxcar->tipe }}</td>
                <td>{{ $boxcar->brand }}</td>
                <td>{{ $boxcar->chasis }}</td>
                <td>{{ $boxcar->model }}</td>
                <td>{{ $boxcar->tonnage }}</td>
                <td>{{ $boxcar->vin}}</td>
                <td>
                    @can('editar-persona')
                            <a class="btn btn-primary" href="{{ route('furgones.edit', $boxcar->id) }}">Editar</a>
                    @endcan
                        @can('borrar-persona')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['furgones.destroy', $boxcar->id], 'style'=>'display:inline']) !!}
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
$(document).ready(function () {$('#furgones').DataTable();});
</script>
@stop