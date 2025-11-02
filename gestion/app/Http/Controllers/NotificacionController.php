<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;
use App\Models\User;

class NotificacionController extends Controller
{
    public function index()
{
    $notificaciones = auth()->user()->notificaciones()->latest()->get();
    return view('notificaciones.index', compact('notificaciones'));
}
}
