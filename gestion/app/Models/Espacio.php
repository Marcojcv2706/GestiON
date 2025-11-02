<?php

namespace App\Models; // Asegúrate de que el namespace sea este

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ASEGÚRATE DE QUE LA CLASE SE LLAME 'Espacio'
class Espacio extends Model 
{
    use HasFactory;

    /**
     * Nombre de la tabla (opcional si es 'espacios').
     */
    protected $table = 'espacios';

    /**
     * Campos que se pueden guardar masivamente.
     * ASEGÚRATE de que 'name' esté aquí.
     */
    protected $fillable = [
        'name', 
        'capacidad', // Si tienes esta columna
    ];

    /**
     * Relación: Un Espacio tiene muchos SubEspacios.
     */
    public function subEspacios()
    {
        return $this->hasMany(SubEspacio::class);
    }

    /**
     * Relación: Un Espacio puede tener muchos Turnos (si aplica).
     */
    public function turnos()
    {
        return $this->hasMany(Turno::class);
    }
}