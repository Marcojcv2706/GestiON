<?php

namespace App\Http\Controllers;

use App\Models\Espacio; // Make sure to use the Espacio model
use Illuminate\Http\Request;

// Define the CORRECT class name here
class EspacioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Use pagination for better performance
        $espacios = Espacio::latest()->paginate(10);
        return view('admin.espacios.index', compact('espacios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.espacios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate using 'name' as that's what the form uses
        $request->validate([
            'name' => 'required|string|max:255|unique:espacios',
            'capacidad' => 'nullable|integer|min:0', // Added validation for capacidad
        ]);
        
        Espacio::create($request->all());
        return redirect()->route('admin.espacios.index')->with('success', 'Espacio creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Espacio $espacio) // Use Route Model Binding
    {
        return view('admin.espacios.edit', compact('espacio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Espacio $espacio)
    {
        // Validate using 'name'
        $request->validate([
            'name' => 'required|string|max:255|unique:espacios,name,' . $espacio->id,
            'capacidad' => 'nullable|integer|min:0', // Added validation for capacidad
        ]);
        
        $espacio->update($request->all());
        return redirect()->route('admin.espacios.index')->with('success', 'Espacio actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Espacio $espacio)
    {
        // Add checks here if needed (e.g., prevent deletion if it has subespacios)
        $espacio->delete();
        return redirect()->route('admin.espacios.index')->with('success', 'Espacio eliminado exitosamente.');
    }
}