@extends('adminlte::page')

@section('title', 'Visitas')

@section('content_header')
    <h1>Visitas Planificadas</h1>
@stop

@section('content')
     @can('crear-persona')
        <a class="btn btn-warning mb-3" href="{{ route('visitas.create') }}">Nuevo</a>
    @endcan
    <table class="table table-hover table-bordered" id="visitas">
        <thead class="thead-dark">
            <tr>
                <th>Cliente</th>
                <th>Técnico</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visits as $visit)
            <tr>
                <td>{{ $visit->partner->ComercialName }}</td>
                <td>{{ $visit->persona->primerNombre }}</td>
                <td>{{ $visit->visit_date }}</td>
                <td>{{ ucfirst($visit->status) }}</td>
                <td>
                            <a href="{{ route('visitas.checkIn', $visit->id) }}" class="btn btn-success btn-sm">Ingresar</a>
                            <a href="{{ route('visitas.checkOut', $visit->id) }}" class="btn btn-danger btn-sm">Salir</a>
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#mapa{{ $visit->id }}">Ver Mapa</button>
                </td>
            </tr>

            {{-- Modal con mapa --}}
            <div class="modal fade" id="mapa{{ $visit->id }}" tabindex="-1" aria-labelledby="mapaLabel{{ $visit->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ubicación del cliente</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div id="map{{ $visit->id }}" style="height: 400px;"></div>
                            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $visit->partner->latitude }},{{ $visit->partner->longitude }}" target="_blank" class="btn btn-primary mt-3">
                                Ver en Google Maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var map = L.map('map{{ $visit->id }}').setView([{{ $visit->partner->latitude }}, {{ $visit->partner->longitude }}], 15);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19
                    }).addTo(map);
                    L.marker([{{ $visit->partner->latitude }}, {{ $visit->partner->longitude }}]).addTo(map)
                        .bindPopup('{{ $visit->partner->ComercialName }}')
                        .openPopup();
                });
            </script>

            @endforeach
        </tbody>
    </table>
@stop

@section('js')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
@stop
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@stop