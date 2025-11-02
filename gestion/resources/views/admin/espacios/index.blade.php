@extends('layouts.app')

@section('title', 'Gestionar Espacios')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Gestionar Espacios</h1>
        <a href="{{ route('admin.espacios.create') }}" class="btn btn-primary">Nuevo Espacio</a>
    </div>

    @include('partials._session-status')

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($espacios as $espacio)
                <tr>
                    <td>{{ $espacio->id }}</td>
                    <td>{{ $espacio->name }}</td>
                    <td>
                        <a href="{{ route('admin.espacios.edit', $espacio) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('admin.espacios.destroy', $espacio) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection