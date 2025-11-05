<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Visit;


class DashboardSupervisor extends Component
{
    public function mount()
    {
        // Lógica de inicialización si es necesario
        $this->actualizarDatos();

    }
    public function actualizarDatos()
    {
        $supervisorId = auth()->id();

        $this->visitasPlanificadas = Visit::where('supervisor_id', $supervisorId)
            ->where('status', 'planificada')->count();

        $this->visitasPendientes = Visit::where('supervisor_id', $supervisorId)
            ->where('status', 'pendiente')->count();

        $this->visitasEnCurso = Visit::where('supervisor_id', $supervisorId)
            ->where('status', 'en_progreso')->count();

        $this->visitasFinalizadas = Visit::where('supervisor_id', $supervisorId)
            ->where('status', 'completada')->count();
    }

    public function render()
    {
        return view('livewire.dashboard-supervisor');
    }
}
