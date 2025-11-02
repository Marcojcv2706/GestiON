@extends('layouts.app')
@section('title', 'Gestionar Recursos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Gestionar Recursos</h1>
        <a href="{{ route('admin.recursos.create') }}" class="btn btn-primary">Crear Recurso</a>
    </div>

    {{-- Muestra mensajes de éxito/error si existen --}}
    @include('partials._session-status') 

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recursos as $recurso)
                            <tr>
                                <td>{{ $recurso->id }}</td>
                                <td>{{ $recurso->name }}</td>
                                <td>
                                    <a href="{{ route('admin.recursos.edit', $recurso) }}" class="btn btn-sm btn-warning me-1">Editar</a>
                                    <form action="{{ route('admin.recursos.destroy', $recurso) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No hay recursos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Links de paginación --}}
            {{ $recursos->links() }}
        </div>
    </div>
@endsection

{{-- Crea este archivo si no lo tienes: resources/views/partials/_session-status.blade.php --}}
{{-- Contenido de _session-status.blade.php:
@if (session('success'))
    <div class="alert alert-success mb-3">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger mb-3">{{ session('error') }}</div>
@endif
--}}