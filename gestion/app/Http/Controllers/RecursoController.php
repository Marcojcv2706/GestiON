<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use Illuminate\Http\Request;

class RecursoController extends Controller
{
    /**
     * Muestra una lista de todos los recursos.
     */
    public function index()
    {
        $recursos = Recurso::latest()->paginate(10);
        return view('admin.recursos.index', compact('recursos'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     */
    public function create()
    {
        return view('admin.recursos.create');
    }

    /**
     * Guarda un nuevo recurso en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:recursos',
        ]);

        Recurso::create($request->all());

        return redirect()->route('admin.recursos.index')->with('success', 'Recurso creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un recurso.
     */
    public function edit(Recurso $recurso)
    {
        return view('admin.recursos.edit', compact('recurso'));
    }

    /**
     * Actualiza un recurso en la base de datos.
     */
    public function update(Request $request, Recurso $recurso)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:recursos,name,' . $recurso->id,
        ]);

        $recurso->update($request->all());

        return redirect()->route('admin.recursos.index')->with('success', 'Recurso actualizado exitosamente.');
    }

    /**
     * Elimina un recurso de la base de datos.
     */
    public function destroy(Recurso $recurso)
    {
        $recurso->delete();
        return redirect()->route('admin.recursos.index')->with('success', 'Recurso eliminado exitosamente.');
    }
}