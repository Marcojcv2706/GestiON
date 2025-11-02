<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Importante para usar softDeletes

class Turno extends Model
{
    use HasFactory, SoftDeletes; // Añadir SoftDeletes

    protected $fillable = [
        'description',
        'start_time',
        'end_time',
        'user_id',
        'recurso_id',
        'espacio_id',
        'sub_espacio_id',
        'actividad_id',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Relaciones
    public function user() { return $this->belongsTo(User::class); }
    public function recurso() { return $this->belongsTo(Recurso::class); }
    public function espacio() { return $this->belongsTo(Espacio::class); }
    public function subEspacio() { return $this->belongsTo(SubEspacio::class); }
    public function actividad() { return $this->belongsTo(Actividad::class); }
}