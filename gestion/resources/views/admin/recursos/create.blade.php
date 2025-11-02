@extends('layouts.app')
@section('title', 'Crear Recurso')

@section('content')
    <h1 class="mt-4">Crear Nuevo Recurso</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.recursos.store') }}" method="POST">
                @csrf
                @include('admin.recursos._form')
            </form>
        </div>
    </div>
@endsection