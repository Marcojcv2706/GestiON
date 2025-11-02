@extends('layouts.app')
@section('title', 'Editar Usuario')

@section('content')
    <h1 class="mt-4">Editar Usuario</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.usuarios.update', $usuario) }}" method="POST">
                @csrf
                @method('PUT')
                {{-- Usamos el formulario parcial --}}
                @include('admin.usuarios._form')
            </form>
        </div>
    </div>
@endsection