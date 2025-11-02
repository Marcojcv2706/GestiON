@extends('layouts.app')

@section('title', 'Mis Turnos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Mis Turnos</h1>
        <a href="{{ route('turnos.create') }}" class="btn btn-primary">Solicitar Nuevo Turno</a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($turnos->isEmpty())
                <p class="text-center">Aún no tienes turnos solicitados.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Actividad</th>
                                <th>Descripción</th>
                                <th>Usuario</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Acciones</th> {{-- Solo una columna de Acciones --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($turnos as $turno)
                                <tr>
                                    <td>{{ $turno->actividad?->name ?? 'Actividad eliminada' }}</td>
                                    <td>{{ $turno->description }}</td>
                                    <td>{{ $turno->user?->name ?? 'Usuario eliminado' }}</td>
                                    <td>{{ $turno->start_time->format('d/m/Y H:i') }}</td>
                                    <td>{{ $turno->end_time->format('d/m/Y H:i') }}</td>
                                    
                                    {{-- UNA SOLA CELDA PARA TODAS LAS ACCIONES --}}
                                    <td>
                                        <a href="{{ route('turnos.edit', $turno) }}" class="btn btn-sm btn-warning me-1">Editar</a>
                                        
                                        <form action="{{ route('turnos.destroy', $turno) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este turno?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                 {{-- Paginación --}}
                {{ $turnos->links() }}
            @endif
        </div>
    </div>
@endsection