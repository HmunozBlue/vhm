@extends('adminlte::page')

@section('title', 'Roles-SkyNet S. A.')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>Roles-SkyNet S. A.</h1>
@stop

@section('content')

    @can('crear-rol')
        <a class="btn btn-warning" href="{{ route('roles.create') }}">Nuevo</a>
        <br>
    @endcan
        <table class="table table-striped mt-2" >
            <thead>
                <th>Rol</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        @can('editar-rol')
                            <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">Editar</a>
                        @endcan
                        @can('borrar-rol')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style'=>'display:inline']) !!}
                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-end">
            {!! $roles->links() !!}
        </div>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop