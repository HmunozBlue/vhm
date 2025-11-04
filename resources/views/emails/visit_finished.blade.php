@component('mail::message')
# Visita completada

La visita al cliente **{{ $visit->partner->ComercialName }}** fue completada.

**Hora de salida:** {{ $visit->check_out_time->format('d/m/Y H:i') }}

Gracias,<br>
{{ config('app.name') }}
@endcomponent