@extends('adminlte::page')

@section('title', 'Viáticos-VHM')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>Viáticos-VHM</h1>
@stop

@section('content')
    @can('crear-persona')
        <a class="btn btn-warning" href="{{ route('viaticos.create')}}">Nuevo</a><br>
    @endcan
    <br>
    <table id="viaticos" class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Monto</th>
            <th>Tipo de Viaje</th>
            <th>Viatico Chofer</th>
            <th>Viatico Ayudante</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($viaticos as $viatico)
            <tr>
                <td>{{ $viatico->id }}</td>
                <td>{{ $viatico->amount }}</td>
                <td>{{ $viatico->tipeTrip }}</td>
                <td>{{ $viatico->travelAllowanceDriver}}</td>
                <td>{{ $viatico->travelAllowanceAssistant}}</td>
                <td>
                    @can('editar-persona')
                        <a class="btn btn-primary" href="{{ route('viaticos.edit', $viatico->id) }}">Editar</a>
                    @endcan
                    @can('borrar-persona')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['viaticos.destroy', $viatico->id], 'style'=>'display:inline']) !!}
                            {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
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
$(document).ready(function () {$('#viaticos').DataTable();});
</script>
@stop