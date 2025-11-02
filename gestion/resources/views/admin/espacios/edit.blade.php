@extends('layouts.app')
@section('title', 'Editar Espacio')
@section('content')
    <h1>Editar Espacio</h1>
    <form action="{{ route('admin.espacios.update', $espacio) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.espacios._form')
    </form>
@endsection