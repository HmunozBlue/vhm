@extends('adminlte::page')

@section('title', 'Administrador-SkyNet S. A.')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1 class="text-2xl font-semibold mb-6">Bienvenido {{ Auth::user()->name }}</h1>
@stop

@section('content')
@livewire('dashboard-supervisor')
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop