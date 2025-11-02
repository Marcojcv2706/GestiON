<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistorialUso;

class HistorialUsoController extends Controller
{
    public function index()
{
    // Muestra solo el historial del usuario logueado
    $historial = auth()->user()->historialUsos()->with('turno')->latest()->paginate(15);
    return view('historial.index', compact('historial'));
}
}
