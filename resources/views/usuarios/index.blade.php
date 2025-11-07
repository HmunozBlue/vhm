@extends('adminlte::page')

@section('title', 'Usuarios-SkyNet S. A.')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>Usuarios-SkyNet S. A.</h1>
@stop

@section('content')
    <p>Usuarios</p>
    @can('crear-rol')        
    <a class="btn btn-warning" href="{{ route('usuarios.create')}}">Nuevo</a><br>
    @endcan
    <br>
    <table class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Nombre</th>
            <th>E-mail</th>
            <th>Rol</th>
            <th colspan="2">Acciones</th>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        @if (!empty($usuario->getRoleNames()))
                            @foreach ($usuario->getRoleNames() as $rolName)
                                <h5><span>{{ $rolName }}</span></h5>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @can('editar-rol')    
                        <a class="btn btn-info" href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a>
                        @endcan
                        @can('borrar-rol')                            
                        {!! Form::open(['method'=>'DELETE', 'route'=>['usuarios.destroy',$usuario->id], 'style'=>'display:inline']) !!}
                            {!! Form::submit('Borrar',['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination justify-content-end">
        {!! $usuarios->links() !!}
    </div>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop