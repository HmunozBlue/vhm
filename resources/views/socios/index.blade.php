@extends('adminlte::page')

@section('title', 'SociosDeNegocios-VHM')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>Socios de negocios-VHM</h1>
@stop

@section('content')
    @can('crear-persona')
        <a class="btn btn-warning" href="{{ route('socios.create')}}">Nuevo</a><br>
    @endcan
    <br>
    <table id="socios" class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Nombre Fiscal</th>
            <th>Nombre Comercial</th>
            <th>Nit</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($partners as $partner)
            <tr>
                <td>{{ $partner->id }}</td>
                <td>{{ $partner->fiscalName }}</td>
                <td>{{ $partner->ComercialName }}</td>
                <td>{{ $partner->nit }}</td>
                <td>{{ $partner->adress }}</td>
                <td>{{ $partner->phone }}</td>
                <td>{{ $partner->email }}</td>
                <td>
                    @can('editar-persona')
                        <a class="btn btn-primary" href="{{ route('socios.edit', $partner->id) }}">Editar</a>
                    @endcan
                    @can('borrar-persona')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['socios.destroy', $partner->id], 'style'=>'display:inline']) !!}
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
$(document).ready(function () {$('#socios').DataTable();});
</script>
@stop