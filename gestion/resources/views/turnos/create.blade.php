@extends('layouts.app')
@section('title', 'Solicitar Turno')

@section('content')
    <h1 class="mt-4">Solicitar Nuevo Turno</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('turnos.store') }}" method="POST">
                @csrf
                {{-- Incluimos el formulario parcial --}}
                @include('turnos._form')
            </form>
        </div>
    </div>
@endsection