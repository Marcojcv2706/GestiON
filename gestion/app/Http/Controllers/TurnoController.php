<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use App\Models\Actividad;
use App\Models\SubEspacio;
use App\Models\Recurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TurnoController extends Controller
{
    /**
     * Muestra la lista de turnos del usuario.
     */
    public function index()
    {
         // Solo muestra los turnos del usuario logueado
         $turnos = Turno::where('user_id', Auth::id()) 
                       ->with('actividad', 'subEspacio') // Carga relaciones para eficiencia
                       ->latest() // Ordena por más reciente
                       ->paginate(10); // Pagina los resultados
         return view('turnos.index', compact('turnos'));
    }

    /**
     * Muestra el formulario para crear un nuevo turno.
     */
    public function create()
    {
        $actividades = Actividad::orderBy('name')->get();
        $subEspacios = SubEspacio::with('espacio')->orderBy('name')->get();
        $recursos = Recurso::orderBy('name')->get();
        return view('turnos.create', compact('actividades', 'subEspacios', 'recursos'));
    }

    /**
     * Guarda un nuevo turno en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description'    => 'required|string|max:255',
            'start_time'     => 'required|date|after_or_equal:now',
            'end_time'       => 'required|date|after:start_time',
            'actividad_id'   => 'required|exists:actividades,id',
            'sub_espacio_id' => 'required|exists:sub_espacios,id',
            'recurso_id'     => 'nullable|exists:recursos,id',
        ]);

        $subEspacio = SubEspacio::find($request->sub_espacio_id);

        Turno::create([
            'description'    => $request->description,
            'start_time'     => $request->start_time,
            'end_time'       => $request->end_time,
            'user_id'        => Auth::id(),
            'actividad_id'   => $request->actividad_id,
            'sub_espacio_id' => $request->sub_espacio_id,
            'recurso_id'     => $request->recurso_id,
            'espacio_id'     => $subEspacio->espacio_id,
        ]);

        return redirect()->route('turnos.index')->with('success', '¡Turno creado exitosamente!');
    }

    /**
     * Muestra el formulario para EDITAR un turno existente.
     * Carga el turno específico y los datos para los desplegables.
     */
    public function edit(Turno $turno)
    {
        // Verifica que el usuario logueado sea el dueño del turno (o un admin si aplica)
        // abort_if($turno->user_id !== Auth::id() && !Auth::user()->rol->isAdmin(), 403); 
        // Descomentar la línea anterior si necesitas esa seguridad extra.

        $actividades = Actividad::orderBy('name')->get();
        $subEspacios = SubEspacio::with('espacio')->orderBy('name')->get();
        $recursos = Recurso::orderBy('name')->get();
        
        // Pasa el $turno y los datos de los select a la vista
        return view('turnos.edit', compact('turno', 'actividades', 'subEspacios', 'recursos'));
    }

    /**
     * ACTUALIZA un turno existente en la base de datos.
     */
    public function update(Request $request, Turno $turno)
    {
        // abort_if($turno->user_id !== Auth::id() && !Auth::user()->rol->isAdmin(), 403);

        $request->validate([
            'description'    => 'required|string|max:255',
            // Al editar, la fecha de inicio puede ser en el pasado si ya empezó
            'start_time'     => 'required|date', 
            'end_time'       => 'required|date|after:start_time',
            'actividad_id'   => 'required|exists:actividades,id',
            'sub_espacio_id' => 'required|exists:sub_espacios,id',
            'recurso_id'     => 'nullable|exists:recursos,id',
        ]);

        $subEspacio = SubEspacio::find($request->sub_espacio_id);

        $turno->update([
            'description'    => $request->description,
            'start_time'     => $request->start_time,
            'end_time'       => $request->end_time,
            'actividad_id'   => $request->actividad_id,
            'sub_espacio_id' => $request->sub_espacio_id,
            'recurso_id'     => $request->recurso_id,
            'espacio_id'     => $subEspacio->espacio_id,
            // No actualizamos 'user_id' al editar
        ]);

        return redirect()->route('turnos.index')->with('success', '¡Turno actualizado exitosamente!');
    }

    /**
     * ELIMINA un turno (Soft Delete).
     */
    public function destroy(Turno $turno)
    {
        // abort_if($turno->user_id !== Auth::id() && !Auth::user()->rol->isAdmin(), 403);

        $turno->delete(); // Soft delete

        return redirect()->route('turnos.index')->with('success', '¡Turno eliminado exitosamente!');
    }
}