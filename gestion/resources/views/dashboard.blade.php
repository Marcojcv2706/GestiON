@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    
    
    {{-- Tarjetas de Estadísticas --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Usuarios Registrados</h5>
                    <p class="card-text fs-2 fw-bold">{{ $totalUsuarios }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Turnos para Hoy</h5>
                    <p class="card-text fs-2 fw-bold">{{ $turnosHoy }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Espacios Disponibles</h5>
                    <p class="card-text fs-2 fw-bold">{{ $totalEspacios }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================================================== --}}
    {{--       SECCIÓN DE TURNOS RECIENTES (CORREGIDA)              --}}
    {{-- ========================================================== --}}
    <div class="card">
        <div class="card-header fs-5 fw-bold">
            Próximos Turnos
        </div>
        <div class="card-body">
            {{-- Usamos @forelse para manejar el caso de que no haya turnos --}}
            @forelse ($proximosTurnos as $turno)
                <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                    <div>
                        <strong class="d-block">{{ $turno->actividad->name ?? 'Actividad no definida' }}</strong>
                        <span class="text-muted">
                            Usuario: {{ $turno->user->name ?? 'N/A' }} | En: {{ $turno->subEspacio->name ?? 'N/A' }}
                        </span>
                    </div>
                    <div class="text-end">
                        <strong class="d-block">{{ $turno->start_time->format('d/m/Y') }}</strong>
                        <span class="badge bg-secondary">{{ $turno->start_time->format('H:i') }} hs</span>
                    </div>
                </div>
            @empty
                {{-- Esto se muestra si $proximosTurnos está vacío --}}
                <p class="text-center text-muted p-3">No hay turnos programados próximamente.</p>
            @endforelse
        </div>
    </div>
@endsection