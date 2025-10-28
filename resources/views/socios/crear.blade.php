@extends('adminlte::page')

@section('title', 'Crear Socio')

@section('content_header')
    <h1>Registrar nuevo socio</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success') }}
        </div>
    @endif

    {{ Form::open(['route' => 'socios.store', 'method' => 'POST']) }}
    <div class="container">
        <div class="row">
            {{-- Datos generales --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nombre Fiscal</label>
                    {!! Form::text('fiscalName', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label>Nombre Comercial</label>
                    {!! Form::text('ComercialName', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label>NIT</label>
                    {!! Form::text('nit', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label>Dirección</label>
                    {!! Form::text('adress', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label>Teléfono</label>
                    {!! Form::number('phone', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label>Correo electrónico</label>
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            {{-- Mapa y coordenadas --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>Selecciona la ubicación en el mapa</label>
                    <div id="map" style="height: 400px; border-radius: 8px;"></div>
                </div>

                <div class="form-group">
                    <label>Latitud</label>
                    {!! Form::text('latitude', null, ['class' => 'form-control', 'id' => 'latitude', 'readonly' => true]) !!}
                </div>

                <div class="form-group">
                    <label>Longitud</label>
                    {!! Form::text('longitude', null, ['class' => 'form-control', 'id' => 'longitude', 'readonly' => true]) !!}
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Guardar
        </button>
    </div>
    {{ Form::close() }}
@stop

@section('css')
    {{-- Estilos de Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@stop

@section('js')
    {{-- Script de Leaflet --}}
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // Inicializa el mapa centrado en Guatemala
        var map = L.map('map').setView([14.6349, -90.5069], 13);

        // Capa base de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Crea un marcador arrastrable
        var marker = L.marker([14.6349, -90.5069], { draggable: true }).addTo(map);

        // Actualiza inputs cuando se arrastra el marcador
        marker.on('dragend', function (e) {
            var lat = marker.getLatLng().lat.toFixed(7);
            var lng = marker.getLatLng().lng.toFixed(7);
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });

        // Permite seleccionar punto al hacer clic en el mapa
        map.on('click', function (e) {
            marker.setLatLng(e.latlng);
            document.getElementById('latitude').value = e.latlng.lat.toFixed(7);
            document.getElementById('longitude').value = e.latlng.lng.toFixed(7);
        });

        // Centrar mapa en la ubicación actual del usuario si da permiso
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                map.setView([lat, lng], 15);
                marker.setLatLng([lat, lng]);
                document.getElementById('latitude').value = lat.toFixed(7);
                document.getElementById('longitude').value = lng.toFixed(7);
            });
        }
    </script>
@stop