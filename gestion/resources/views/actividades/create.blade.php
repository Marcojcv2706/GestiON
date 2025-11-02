@extends('layouts.app')
@section('title', 'Crear Actividad')

@section('content')
    <h1 class="mt-4">Crear Nueva Actividad</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('actividades.store') }}" method="POST">
                @csrf
                @include('actividades._form')
            </form>
        </div>
    </div>
@endsection