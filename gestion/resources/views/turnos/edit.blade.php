@extends('layouts.app')

@section('title', 'Editar Turno')

@section('content')
    <h1 class="mt-4">Editar Turno</h1>

    <div class="card">
        <div class="card-body">
            {{-- El formulario apunta a la ruta 'turnos.update' con el método PUT --}}
            <form action="{{ route('turnos.update', $turno) }}" method="POST">
                @csrf
                @method('PUT') {{-- Importante para indicar que es una actualización --}}

                {{-- Incluimos el mismo formulario parcial que usa 'create' --}}
                {{-- La vista le pasa automáticamente la variable $turno --}}
                @include('turnos._form')

            </form>
        </div>
    </div>
@endsection