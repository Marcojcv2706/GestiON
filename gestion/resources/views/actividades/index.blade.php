@extends('layouts.app')
@section('title', 'Listado de Actividades')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Actividades</h1>
        
        {{-- ESTE BOTÓN SOLO APARECE SI EL USUARIO TIENE PERMISO --}}
        @can('gestionar-actividades')
            <a href="{{ route('actividades.create') }}" class="btn btn-primary">Crear Actividad</a>
        @endcan
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Sub-espacio</th>
                            <th>Creado por</th>
                            {{-- LA COLUMNA DE ACCIONES SOLO ES VISIBLE PARA ROLES CON PERMISO --}}
                            @can('gestionar-actividades')
                                <th>Acciones</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($actividades as $actividad)
                            <tr>
                                <td>{{ $actividad->name }}</td>
                                <td>{{ $actividad->subEspacio?->name ?? 'N/A' }}</td>
                                <td>{{ $actividad->creador?->name ?? 'N/A' }}</td>
                                @can('gestionar-actividades')
                                    <td>
                                        <a href="{{ route('actividades.edit', $actividad) }}" class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('actividades.destroy', $actividad) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro?')">Eliminar</button>
                                        </form>
                                    </td>
                                @endcan
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No hay actividades registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $actividades->links() }}
        </div>
    </div>
@endsection