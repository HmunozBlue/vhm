@extends('adminlte::page')

@section('title', 'Viajes-VHM')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>Viajes-VHM</h1>
@stop

@section('content')
<body>
    {{-- FORMULARIO DE CONSULTA POR FECHAS --}}
    <div class="container">
      <h4>Gestión de Pagos Choferes</h4>
      <br>
      <div class="row">
        <div class="col-xl-12">
          {{ Form::open(array('route' => 'pagos.index', 'method'=>'GET')) }}
                <label for="fechaInicio">Fecha Inicio: </label>
                <div class="form-row">
                  <div class="col-sm-4 my-2">
                      <input type="date" class="form-control" name="fechaInicio" value="{{ $dateStart }}">
                  </div>
                </div>
                <label for="fechaInicio">Fecha fin: </label>
                <div class="form-row">
                  <div class="col-sm-4 my-2">
                    <input type="date" class="form-control" name="fechaFin" value="{{ $dateEnd }}">
                  </div>
                </div>
                <div class="form-row">  
                  <div class="col-auto">
                    <input type="submit" class="btn btn-primary" value="Buscar">
                  </div>
                </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
    {{-- TABLA DONDE ESTA LA INFORMACION TRAIDA DE LA BASE DE DATOS --}}
    <table  id="viajes" class="table table-hover">
      <thead>
          <th>ID</th>
          <th>Guias</th>
          <th>Tipo Viaje</th>
          <th>Pago</th>
          <th>Vehiculo</th>
          <th>Furgon</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>DPI</th>
          <th>Fecha Viaje</th>
      </thead>
      <tbody>
        @if (count($payments)<=0)
          <tr>
            <td colspan="10" style="color:#eb984e"> Sin resultados. </td>
          </tr>
        @else
          @foreach ($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->guies }}</td>
                <td>{{ $payment->tipeTrip }}</td>
                <td>{{ $payment->travelAllowanceDriver }}</td>
                <td>{{ $payment->vehicle }}</td>
                <td>{{ $payment->boxcar }}</td>
                <td>{{ $payment->primerNombre }}</td>
                <td>{{ $payment->primerApellido }}</td>
                <td>{{ $payment->CUI }}</td>
                <td>{{ $payment->created_at }}</td>
            </tr>
          @endforeach
        @endif
      </tbody>
    </table>
    <br>
    {{-- CONTENEDOR DEL MONTO A PAGAR --}}
    <div class="container">
      <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
              TOTAL A PAGAR:
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                @php $total=0 @endphp
                @foreach ($payments as $payment)
                @php $total = $payment->travelAllowanceDriver + $total @endphp
                @endforeach
                <p style="color:#eb984e"><strong>Q{{$total}}</strong> </p>
              </blockquote>
            </div>
        </div>  
      </div>
    </div>
</body>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"></script>
<script src="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"></script>
<script> 
$(document).ready(function () {$('#viajes').DataTable();});
</script>
@stop