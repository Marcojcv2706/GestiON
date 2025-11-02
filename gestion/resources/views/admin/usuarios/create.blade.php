@extends('layouts.app')
@section('title', 'Crear Usuario')

@section('content')
    <h1 class="mt-4">Crear Nuevo Usuario</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.usuarios.store') }}" method="POST">
                @csrf
                {{-- Usamos el formulario parcial --}}
                @include('admin.usuarios._form')
            </form>
        </div>
    </div>
@endsection