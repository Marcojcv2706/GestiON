<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// --- ¡LÍNEA AÑADIDA AQUÍ! ---
use App\Models\Espacio; 

class SubEspacio extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada.
     */
    protected $table = 'sub_espacios';

    /**
     * Atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'name',
        'espacio_id',
        // Agrega otros campos si los tienes
    ];

    /**
     * Define la relación inversa con Espacio.
     * Un SubEspacio pertenece a un Espacio.
     */
    public function espacio()
    {
        // Ahora PHP sabe qué es 'Espacio::class'
        return $this->belongsTo(Espacio::class); 
    }

    /**
     * Define la relación con Turno.
     * Un SubEspacio puede tener muchos Turnos.
     */
    public function turnos()
    {
        return $this->hasMany(Turno::class);
    }

    /**
     * Define la relación con Actividad.
     * Un SubEspacio puede tener muchas Actividades.
     */
     public function actividades()
    {
        return $this->hasMany(Actividad::class);
    }
}