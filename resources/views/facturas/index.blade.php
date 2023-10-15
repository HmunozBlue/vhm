@extends('adminlte::page')

@section('title', 'Facturas-VHM')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>Facturas-VHM</h1>
@stop

@section('content')
    @can('crear-persona')
        <a class="btn btn-warning" href="{{ route('facturas.create')}}">Nuevo</a><br>
    @endcan
    <br>
    <table id="facturas" class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Fecha Emisión</th>
            <th>Número de Autorización</th>
            <th>Serie</th>
            <th>Número del DTE</th>
            <th>Nit receptor</th>
            <th>Nombre del receptor</th>
            <th>Monto</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($billing as $billin)
                <tr>
                    <td>{{ $billin->id }}</td>
                    <td>{{ $billin->dateTimeEmission }}</td>
                    <td>{{ $billin->numAutorization }}</td>
                    <td>{{ $billin->serie }}</td>
                    <td>{{ $billin->number }}</td>
                    <td>{{ $billin->idReceptor }}</td>
                    <td>{{ $billin->nameReceptor }}</td>
                    <td>{{ $billin->total }}</td>
                    <td>
                        @can('editar-persona')
                            <a class="btn btn-primary" href="{{ route('facturas.edit', $billin->id) }}">Editar</a>
                        @endcan
                        @can('borrar-persona')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['facturas.destroy', $billin->id], 'style'=>'display:inline']) !!}
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
$(document).ready(function () {$('#facturas').DataTable();});
</script>
@stop