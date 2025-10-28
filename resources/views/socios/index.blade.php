@extends('adminlte::page')

@section('title', 'Listado de socios')

@section('content_header')
    <h1>Socios registrados</h1>
@stop

@section('content')
    @can('crear-persona')
        <a class="btn btn-warning mb-3" href="{{ route('socios.create') }}">Nuevo</a>
    @endcan

    <table id="socios" class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre Fiscal</th>
                <th>Nombre Comercial</th>
                <th>NIT</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Ubicación</th>
                <th>Acciones</th>
            </tr>
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
                        @if($partner->latitude && $partner->longitude)
                            <button 
                                class="btn btn-success btn-sm view-map-btn" 
                                data-toggle="modal" 
                                data-target="#mapModalView" 
                                data-lat="{{ $partner->latitude }}" 
                                data-lng="{{ $partner->longitude }}"
                                data-name="{{ $partner->ComercialName }}">
                                <i class="fas fa-map-marker-alt"></i> Ver
                            </button>
                        @else
                            <span class="badge badge-secondary">Sin ubicación</span>
                        @endif
                    </td>
                    <td>
                        @can('editar-persona')
                            <a class="btn btn-primary btn-sm" href="{{ route('socios.edit', $partner->id) }}">Editar</a>
                        @endcan
                        @can('borrar-persona')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['socios.destroy', $partner->id], 'style'=>'display:inline']) !!}
                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endcan

                        {{-- Ver Ruta (usa los mismos campos latitude/longitude) --}}
                        @if($partner->latitude && $partner->longitude)
                            <button class="btn btn-info btn-sm route-btn"
                                    data-toggle="modal"
                                    data-target="#mapModalRoute"
                                    data-lat="{{ $partner->latitude }}"
                                    data-lng="{{ $partner->longitude }}"
                                    data-name="{{ $partner->ComercialName }}">
                                <i class="fas fa-route"></i> Ver Ruta
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Modal: Ver ubicación (solo mostrar marcador) --}}
    <div class="modal fade" id="mapModalView" tabindex="-1" role="dialog" aria-labelledby="mapModalViewLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="mapModalViewLabel">Ubicación del socio</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="mapView" style="height: 400px; width: 100%; border-radius: 8px;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal: Ruta desde tu ubicación hasta cliente --}}
    <div class="modal fade" id="mapModalRoute" tabindex="-1" role="dialog" aria-labelledby="mapModalRouteLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <h5 class="modal-title" id="mapModalRouteLabel">Ruta hacia el cliente</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="mapRoute" style="height: 500px; width: 100%;"></div>
          </div>
        </div>
      </div>
    </div>
@stop

@section('css')
    {{-- CSS de Leaflet y DataTables --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
@stop

@section('js')
    {{-- JQuery ya viene con AdminLTE; agregar Leaflet, Routing y DataTables (no duplicar) --}}
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
    $(document).ready(function () {
        $('#socios').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json' }
        });
    });

    // -----------------------
    // VER UBICACIÓN (modal mapModalView -> #mapView)
    // -----------------------
    var mapView, markerView;
    $('#mapModalView').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var lat = parseFloat(button.data('lat'));
        var lng = parseFloat(button.data('lng'));
        var name = button.data('name') || 'Ubicación';

        // Inicializa / reusa mapa
        setTimeout(function () {
            if (!mapView) {
                mapView = L.map('mapView').setView([lat, lng], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap'
                }).addTo(mapView);

                markerView = L.marker([lat, lng]).addTo(mapView).bindPopup('<b>' + name + '</b>').openPopup();
            } else {
                mapView.setView([lat, lng], 15);
                markerView.setLatLng([lat, lng]).bindPopup('<b>' + name + '</b>').openPopup();
                mapView.invalidateSize();
            }
        }, 200);
    });

    // -----------------------
    // RUTA (modal mapModalRoute -> #mapRoute)
    // -----------------------
    var mapRoute, routingControl;

    $('#mapModalRoute').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var lat = parseFloat(button.data('lat'));
        var lng = parseFloat(button.data('lng'));
        var name = button.data('name') || 'Cliente';

        // Delay pequeño para que el modal ya esté visible/medible
        setTimeout(function () {
            // Si existía un mapa previo lo eliminamos (para evitar conflictos)
            if (mapRoute) {
                try { mapRoute.remove(); } catch(e) {}
                mapRoute = null;
                routingControl = null;
            }

            mapRoute = L.map('mapRoute').setView([lat, lng], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(mapRoute);

            // marcador cliente
            L.marker([lat, lng]).addTo(mapRoute).bindPopup('<b>' + name + '</b>');

            // Obtener ubicación del usuario
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (pos) {
                    var userLat = pos.coords.latitude;
                    var userLng = pos.coords.longitude;

                    L.marker([userLat, userLng]).addTo(mapRoute).bindPopup('Tu ubicación');

                    // Añadir control de ruta
                    routingControl = L.Routing.control({
                        waypoints: [
                            L.latLng(userLat, userLng),
                            L.latLng(lat, lng)
                        ],
                        routeWhileDragging: false,
                        showAlternatives: false
                    }).addTo(mapRoute);

                }, function (err) {
                    alert("No se pudo obtener tu ubicación: " + err.message);
                }, { enableHighAccuracy: true });
            } else {
                alert("Geolocalización no soportada por el navegador.");
            }
        }, 300);
    });

    // Al cerrar, asegurarse de invalidar tamaños
    $('#mapModalView, #mapModalRoute').on('hidden.bs.modal', function () {
        if (mapView) mapView.invalidateSize();
        if (mapRoute) mapRoute.invalidateSize();
    });
    </script>
@stop
