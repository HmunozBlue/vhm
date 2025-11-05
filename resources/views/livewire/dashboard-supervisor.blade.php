<div>
    <h3 class="text-lg font-bold">Estado actual de visitas</h3>
    {{--<div class="grid grid-cols-3 gap-4 text-center mt-4">
        <div class="bg-yellow-100 p-4 rounded-xl">
            <p>Pendientes</p>
            <h1 class="text-2xl font-bold">{{ $visitasPendientes }}</h1>
        </div>
        <div class="bg-blue-100 p-4 rounded-xl">
            <p>En curso</p>
            <h1 class="text-2xl font-bold">{{ $visitasEnCurso }}</h1>
        </div>
        <div class="bg-green-100 p-4 rounded-xl">
            <p>Completadas</p>
            <h1 class="text-2xl font-bold">{{ $visitasFinalizadas }}</h1>
        </div>
    </div>--}}

    <div class="container mt-4">
    <h3 class="fw-bold mb-4 text-primary">
        <i class="bi bi-graph-up"></i> Estado actual de visitas
    </h3>

    <div class="row text-center">
        {{-- Tarjeta Planificadas --}}
        <div class="col-md-4 mb-3">
            <div class="card border-secondary shadow-sm">
                <div class="card-body bg-secondary bg-opacity-10 rounded-3">
                    <h5 class="card-title fw-semibold">
                        <i class="bi bi-calendar2-check-fill"></i> Planificadas
                    </h5>
                    <h1 class="display-5 fw-bold mb-0">
                        {{ $visitasPlanificadas }}
                    </h1>
                </div>
            </div>
        </div>
        {{-- Tarjeta Pendientes --}}
        <div class="col-md-4 mb-3">
            <div class="card border-warning shadow-sm">
                <div class="card-body bg-warning bg-opacity-10 rounded-3">
                    <h5 class="card-title fw-semibold">
                        <i class="bi bi-hourglass-split"></i> Pendientes
                    </h5>
                    <h1 class="display-5 fw-bold mb-0">
                        {{ $visitasPendientes }}
                    </h1>
                </div>
            </div>
        </div>

        {{-- Tarjeta En Curso --}}
        <div class="col-md-4 mb-3">
            <div class="card border-primary shadow-sm">
                <div class="card-body bg-primary bg-opacity-10 rounded-3">
                    <h5 class="card-title fw-semibold">
                        <i class="bi bi-arrow-repeat"></i> En curso
                    </h5>
                    <h1 class="display-5 fw-bold mb-0">
                        {{ $visitasEnCurso }}
                    </h1>
                </div>
            </div>
        </div>

        {{-- Tarjeta Finalizadas --}}
        <div class="col-md-4 mb-3">
            <div class="card border-success shadow-sm">
                <div class="card-body bg-success bg-opacity-10 rounded-3">
                    <h5 class="card-title fw-semibold">
                        <i class="bi bi-check-circle"></i> Completadas
                    </h5>
                    <h1 class="display-5 fw-bold mb-0">
                        {{ $visitasFinalizadas }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>


    {{-- Actualización automática cada 10 segundos --}}
    <script>
        setInterval(() => {
            Livewire.emit('refreshComponent');
        }, 10000);
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    </script>
</div>