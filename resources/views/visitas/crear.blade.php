@extends('adminlte::page')

@section('title', 'Crear Visita')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('content_header')
    <h1>Registrar nueva visita</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Por favor corrige los siguientes errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- FORMULARIO DE CREACIÓN DE VISITA --}}
    {!! Form::open(['route' => 'visitas.store', 'method' => 'POST']) !!}
    <div class="container">
    <div class="row">

        {{-- Cliente (Partner) --}}
        <div class="col-md-6">
            <div class="form-group">
                <label for="partner_id">Cliente (Socio)</label>
                {{--{!! Form::select('partner_id', $partners, null, ['class' => 'form-control', 'placeholder' => 'Seleccione un cliente']) !!}--}}
                <select name="partner_id" id="partner_id" class="form-control" required>
                    @foreach ($partners as $partner)
                        <option value="{{ $partner->id }}"> {{ $partner->ComercialName }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Técnico asignado --}}
        <div class="col-md-6">
            <div class="form-group">
                <label for="technician_id">Técnico asignado</label>
                {{--{!! Form::select('technician_id', $technicians, null, ['class' => 'form-control', 'placeholder' => 'Seleccione un técnico']) !!}--}}
                <select name="technician_id" id="technician_id" class="form-control" required>
                    @foreach ($personas as $persona)
                        <option value="{{ $persona->id }}"> {{ $persona->primerNombre }}-{{ $persona->primerApellido }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Fecha de visita --}}
        <div class="col-md-6">
            <div class="form-group">
                <label for="visit_date">Fecha de visita</label>
                {!! Form::date('visit_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
            </div>
        </div>

        {{-- Hora planificada --}}
        <div class="col-md-6">
            <div class="form-group">
                <label for="planned_time">Hora planificada</label>
                {!! Form::time('planned_time', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        {{-- Estado --}}
        <div class="col-md-6">
            <div class="form-group">
                <label for="status">Estado</label>
                {!! Form::select('status', [
                    'pendiente' => 'Pendiente',
                    'en_progreso' => 'En progreso',
                    'completada' => 'Completada',
                    'cancelada' => 'Cancelada'
                ], null, ['class' => 'form-control']) !!}
            </div>
        </div>

        {{-- Ubicación en mapa --}}
        <div class="col-md-12">
            <div class="form-group">
                <label>Ubicación de la visita</label>
                <div id="map" style="height: 350px; border-radius: 8px;"></div>
            </div>
        </div>

        {{-- Campos ocultos para guardar coordenadas --}}
        {!! Form::hidden('latitude', null, ['id' => 'latitude']) !!}
        {!! Form::hidden('longitude', null, ['id' => 'longitude']) !!}

        {{-- Botón --}}
        <div class="col-12 text-center mt-3">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Guardar visita
            </button>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js')
    {{-- Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // Inicializar el mapa centrado en una ubicación por defecto (Ciudad de Guatemala)
        const map = L.map('map').setView([14.6349, -90.5069], 12);

        // Capa base OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker;

        // Permitir al usuario elegir punto en el mapa
        map.on('click', function (e) {
            const { lat, lng } = e.latlng;

            // Si ya existe marcador, moverlo
            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng]).addTo(map);
            }

            // Asignar valores a los campos ocultos
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });
    </script>
@stop
