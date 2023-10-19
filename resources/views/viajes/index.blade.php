@extends('adminlte::page')

@section('title', 'Viajes-VHM')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>Viajes-VHM</h1>
@stop

@section('content')
@can('crear-persona')
    <a class="btn btn-warning" href="{{ route('viajes.create')}}">Nuevo</a><br>
@endcan
<br>
<table  id="viajes" class="table table-hover">
    <thead>
        <th>ID</th>
        <th>No de Guia</th>
        <th>Valor</th>
        <th>tipo</th>
        <th>Vehiculo</th>
        <th>comentario</th>
        <th>Fecha Viaje</th>
        <th>Acciones</th>
    </thead>
    <tbody>
        @foreach ($tour as $tours)
            <tr>
                <td>{{ $tours->id }}</td>
                <td>{{ $tours->guies }}</td>
                <td>{{ $tours->amount }}</td>
                <td>{{ $tours->tipeTrip }}</td>
                <td>{{ $tours->carPlate }}</td>
                <td>{{ $tours->comment }}</td>
                <td>{{ $tours->created_at }}</td>
                <td>
                    @can('editar-persona')
                            <a class="btn btn-primary" href="{{ route('viajes.edit', $tours->id) }}">Editar</a>
                    @endcan
                        @can('borrar-persona')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['viajes.destroy', $tours->id], 'style'=>'display:inline']) !!}
                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger', ]) !!}
                            {!! Form::close() !!}
                        @endcan
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop


@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"></script>
<script src="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"></script>
<script> 
$(document).ready(function () {$('#viajes').DataTable();});
</script>
@stop