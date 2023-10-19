@extends('adminlte::page')

@section('title', 'Viajes-VHM')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('content_header')
    <h1>Viajes-VHM</h1>
@stop

@section('content')

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
        </tbody>
</table>
<br>
<div class="card">
    <div class="card-header">
      Total a pagar
    </div>
    <div class="card-body">
      <blockquote class="blockquote mb-0">
        @php $total=0 @endphp
        @foreach ($payments as $payment)
        @php $total = $payment->travelAllowanceDriver + $total @endphp
        @endforeach
        <p>Total: Q{{$total}}</p>
      </blockquote>
    </div>
  </div>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"></script>
<script src="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"></script>
<script> 
$(document).ready(function () {$('#viajes').DataTable();});
</script>
@stop