<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'role_id');
    }

    public function turnos()
    {
        return $this->hasMany(Turno::class);
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class);
    }

    public function historialUsos()
    {
        return $this->hasMany(HistorialUso::class);
    }
    
    public function actividadesCreadas()
    {
        return $this->hasMany(Actividad::class, 'user_id');
    }
}