<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * (Opcional si tu tabla se llama 'recursos')
     */
    protected $table = 'recursos';

    /**
     * The attributes that are mass assignable.
     * CORREGIDO: Cambiamos 'nombre' por 'name'.
     */
    protected $fillable = [
        'name',         // <-- CORREGIDO
        'descripcion',  // Mantenemos 'descripcion' si existe esa columna
    ];

    /**
     * Define la relación con Turno.
     */
    public function turnos()
    {
        return $this->hasMany(Turno::class);
    }
}