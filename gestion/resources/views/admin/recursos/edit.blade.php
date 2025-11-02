@extends('layouts.app')
@section('title', 'Editar Recurso')

@section('content')
    <h1 class="mt-4">Editar Recurso</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.recursos.update', $recurso) }}" method="POST">
                @csrf
                @method('PUT') {{-- Importante para la actualización --}}
                @include('admin.recursos._form')
            </form>
        </div>
    </div>
@endsection