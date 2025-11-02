<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\SubEspacio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ActividadController extends Controller
{
    // Muestra la lista de actividades (ya lo tenías)
    public function index()
    {
        $actividades = Actividad::with('creador', 'subEspacio')->latest()->paginate(10);
        return view('actividades.index', compact('actividades'));
    }

    // Muestra el formulario para AGREGAR una nueva actividad
    public function create()
    {
        abort_if(!Gate::allows('gestionar-actividades'), 403, 'No tienes permiso para crear actividades.');
        
        $subEspacios = SubEspacio::orderBy('name')->get();
        return view('actividades.create', compact('subEspacios'));
    }

    // Guarda la nueva actividad en la base de datos
    public function store(Request $request)
    {
        abort_if(!Gate::allows('gestionar-actividades'), 403);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:actividades',
            'sub_espacio_id' => 'required|exists:sub_espacios,id',
            'description' => 'nullable|string',
        ]);

        Actividad::create([
            'name' => $request->name,
            'description' => $request->description,
            'sub_espacio_id' => $request->sub_espacio_id,
            'user_id' => auth()->id(), // El creador es el usuario logueado
        ]);

        return redirect()->route('actividades.index')->with('success', 'Actividad creada exitosamente.');
    }

    // Muestra el formulario para EDITAR una actividad existente
    public function edit(Actividad $actividad)
    {
        abort_if(!Gate::allows('gestionar-actividades'), 403, 'No tienes permiso para editar actividades.');
        
        $subEspacios = SubEspacio::orderBy('name')->get();
        return view('actividades.edit', compact('actividad', 'subEspacios'));
    }

    // Actualiza la actividad en la base de datos
    public function update(Request $request, Actividad $actividad)
    {
        abort_if(!Gate::allows('gestionar-actividades'), 403);

        $request->validate([
            'name' => 'required|string|max:255|unique:actividades,name,' . $actividad->id,
            'sub_espacio_id' => 'required|exists:sub_espacios,id',
            'description' => 'nullable|string',
        ]);
        
        $actividad->update($request->all());

        return redirect()->route('actividades.index')->with('success', 'Actividad actualizada exitosamente.');
    }

    // ELIMINA la actividad de la base de datos
    public function destroy(Actividad $actividad)
    {
        abort_if(!Gate::allows('gestionar-actividades'), 403, 'No tienes permiso para eliminar actividades.');
        
        $actividad->delete();
        
        return redirect()->route('actividades.index')->with('success', 'Actividad eliminada exitosamente.');
    }
}