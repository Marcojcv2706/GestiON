@extends('layouts.app')
@section('title', 'Crear Espacio')
@section('content')
    <h1>Crear Nuevo Espacio</h1>
    <form action="{{ route('admin.espacios.store') }}" method="POST">
        @csrf
        @include('admin.espacios._form')
    </form>
@endsection