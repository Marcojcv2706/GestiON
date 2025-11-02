<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';


    protected $fillable = [
        'name',
        'description',
        'sub_espacio_id',
        'user_id', 
    ];


    public function subEspacio()
    {
        return $this->belongsTo(SubEspacio::class);
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function turnos()
    {
        return $this->hasMany(Turno::class);
    }
}