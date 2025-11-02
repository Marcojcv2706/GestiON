@extends('layouts.app')
@section('title', 'Editar Actividad')

@section('content')
    <h1 class="mt-4">Editar Actividad</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('actividades.update', $actividad) }}" method="POST">
                @csrf
                @method('PUT')
                @include('actividades._form')
            </form>
        </div>
    </div>
@endsection