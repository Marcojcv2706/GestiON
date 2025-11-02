<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialUso extends Model
{
    use HasFactory;

    protected $table = 'historial_usos';

    protected $fillable = [
        'action', 
        'user_id',
        'turno_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }
}   