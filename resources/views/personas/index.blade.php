@extends('adminlte::page')

@section('title', 'Personas-SkyNet S. A.')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>Personas-SkyNet S. A.</h1>
@stop

@section('content')
    @can('crear-persona')
        <a class="btn btn-warning" href="{{ route('personas.create')}}">Nuevo</a><br>
    @endcan
    <br>
    <table id="personas" class="table table-hover">
        <thead>
            <th>ID</th>
            <th>PrimerNombre</th>
            <th>Otros Nombres</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>
            <th>Genero</th>
            <th>Fecha de nacimiento</th>
            <th>CUI</th>
            <th>NIT</th>
            <th>Pais</th>
            <th>Departamento</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($personas as $persona)
                <tr>
                    <td> {{ $persona->id }} </td>
                    <td> {{ $persona->primerNombre }} </td>
                    <td>{{ $persona->segundoNombre }}</td>
                    <td>{{ $persona->primerApellido }}</td>
                    <td>{{ $persona->segundoApellido }}</td>
                    <td>{{ $persona->genero }}</td>
                    <td>{{ $persona->fechaNacimiento }}</td>
                    <td>{{ $persona->CUI }}</td>
                    <td>{{ $persona->NIT }}</td>
                    <td>{{ $persona->pais }}</td>
                    <td>{{ $persona->departamento }}</td>
                    <td>
                        @can('editar-persona')
                            <a class="btn btn-primary" href="{{ route('personas.edit', $persona->id) }}">Editar</a>
                        @endcan
                        @can('borrar-persona')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['personas.destroy', $persona->id], 'style'=>'display:inline']) !!}
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
$(document).ready(function () {$('#personas').DataTable();});
</script>
@stop